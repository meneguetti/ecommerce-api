<?php

namespace App\Services;

use App\Mail\OrderPurchased;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class CartService
{

    public function checkout()
    {
        $response = ['success' => false];

        try {
            $cart = (new Cart)->getProducts();
            if ($cart['total_quantity'] > 0) {

                Mail::to(auth()->user()->email)
                        ->send(new OrderPurchased($cart));
                $cartIds = Arr::pluck($cart['products'], 'id');

                // delete cart products
                Cart::destroy($cartIds);

                $response['success'] = true;
                $response['message'] = Mail::failures();
            } else {
                $response['message'] = 'Empty Cart';
            }
        } catch (Exception $ex) {
            $response['message'] = $ex->getMessage();
        }

        return $response;
    }

}
