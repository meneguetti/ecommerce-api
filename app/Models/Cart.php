<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function saveProduct($productId)
    {
        $cartProduct = $this->firstOrNew([
            'product_id' => $productId,
            'user_id'    => auth()->user()->id
        ]);

        $cartProduct->quantity = ++$cartProduct->quantity ?? 1;
        $cartProduct->save();

        return $cartProduct;
    }

    public function getProducts()
    {
        $cartProducts = DB::table('carts as c')
                ->select(
                        'c.id',
                        'c.product_id',
                        'p.name',
                        'c.quantity',
                        'p.price',
                        'p.thumbnail'
                )
                ->leftJoin('products as p', 'p.id', '=', 'c.product_id')
                ->where('user_id', auth()->user()->id)
                ->get();

        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($cartProducts as $cartProduct) {
            $totalPrice += $cartProduct->price * $cartProduct->quantity;
            $totalQuantity += $cartProduct->quantity;
        }

        return [
            'total_price'    => $totalPrice,
            'total_quantity' => $totalQuantity,
            'products'       => $cartProducts
        ];
    }

    public function decreaseProduct($productId)
    {
        $product = self::where('user_id', auth()->user()->id)
                ->where('product_id', $productId)
                ->first();

        if ($product->quantity > 1) {
            $product->quantity--;
            $product = $product->save();
        } else {
            $product = $product->delete();
        }

        return $product;
    }

}
