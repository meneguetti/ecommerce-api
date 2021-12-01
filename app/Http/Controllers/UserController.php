<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use function auth;
use function view;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email'    => 'required',
            'password' => 'required',
        ];

        if (Validator::make($request->all(), $rules)->passes()) {

            $user = User::where('email', $request->get('email'))->first();

            if ($user) {
                return ['success' => false, 'message' => 'Email already exists!'];
            }

            $user = User::create([
                        'name'     => $request->get('fullname'),
                        'email'    => $request->get('email'),
                        'password' => Hash::make($request->get('password')),
            ]);

            if ($user) {
                Auth::login($user);

                return [
                    'message' => 'You are registered and logged in!<br />',
                    'params'  => [
                        'token' => auth()->user()->createToken(auth()->user()->email)->plainTextToken,
                        'email' => auth()->user()->email,
                        'name'  => auth()->user()->name
                    ],
                    'success' => true
                ];
            }
        } else {
            return ['success' => false, 'message' => 'Register failed!'];
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return [
                'message' => 'You are logged in!<br />',
                'params'  => [
                    'token' => auth()->user()->createToken(auth()->user()->email)->plainTextToken,
                    'email' => auth()->user()->email,
                    'name'  => auth()->user()->name
                ],
                'success' => true
            ];
        } else {
            return ['success' => false, 'message' => 'login failed!'];
        }
    }

    public function logout()
    {
        $token = PersonalAccessToken::findToken(str_ireplace('Bearer ', '', request()->header('Authorization')));

        if ($token) {
            $token->delete();
            Auth::guard('web')->logout();
            return ['message' => 'You are now logged out!', 'success' => true];
        }

        return ['success' => false];
    }

}
