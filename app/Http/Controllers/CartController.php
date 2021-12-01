<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function getProducts()
    {
        return (new Cart)->getProducts();
    }

    public function saveProduct(Request $request)
    {
        return (new Cart)->saveProduct($request->get('product_id'));
    }

    public function decreaseProduct(Request $request, int $productId)
    {
        return (new Cart)->decreaseProduct($productId);
    }

    public function checkout(Request $request)
    {
        return (new CartService())->checkout($request->post('checkout'));
    }

}
