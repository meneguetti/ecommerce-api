<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function get(Request $request)
    {
        return (new CartService)->get();
    }

    public function saveProduct(Request $request)
    {

        return $request->all();
    }

}
