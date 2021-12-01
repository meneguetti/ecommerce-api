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

    public function saveProduct($data)
    {
        $cartProduct = $this->firstOrNew([
            'product_id' => $data['product_id'],
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

}
