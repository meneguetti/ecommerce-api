<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getAll(Request $request)
    {
        $itemsByPage = 2;
        $page = (int) $request->get('page', 1);

        return (new Product)->getByPage($itemsByPage, $page);
    }

}
