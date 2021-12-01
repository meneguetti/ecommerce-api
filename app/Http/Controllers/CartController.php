<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function getProducts()
    {
        return (new Cart)->getProducts();
    }

    public function saveProduct(Request $request)
    {
        return (new Cart)->saveProduct($request->all());
    }

}
