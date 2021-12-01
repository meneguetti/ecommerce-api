<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CartTest extends TestCase
{

    use DatabaseMigrations;

    public function test_user_add_cart_products()
    {
        $user = User::factory()->create();

        $this->seed();

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);
        $response->assertJsonFragment(['product_id' => $product, 'quantity' => 1]);
        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);
        $response->assertJsonFragment(['product_id' => $product, 'quantity' => 2]);

        $product = 3;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);
        $response->assertJsonFragment(['product_id' => $product, 'quantity' => 1]);
    }

    public function test_user_get_cart_products()
    {
        $user = User::factory()->create();

        $this->seed();

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $product = 3;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $response = $this->actingAs($user)->get('/api/cart/products');
        $response->assertJson([
            'total_quantity' => 3,
            'products'       => [
                [
                    'product_id' => 1,
                    'quantity'   => 2,
                ],
                [
                    'product_id' => 3,
                    'quantity'   => 1,
                ]
            ]
        ]);
    }

    public function test_user_delete_cart_product()
    {
        $user = User::factory()->create();

        $this->seed();

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $product = 3;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        // delete product (id = 3) from cart
        $productIdToDelete = 3;
        $response = $this->actingAs($user)->delete('/api/cart/products/' . $productIdToDelete);

        $response = $this->actingAs($user)->get('/api/cart/products');
        $response->assertJson([
            'total_quantity' => 1,
            'products'       => [
                [
                    'product_id' => 1,
                    'quantity'   => 1,
                ]
            ]
        ]);

        $response->assertJsonMissing([
            'product_id' => $productIdToDelete,
        ]);
    }

    public function test_user_decrease_quantity_of_a_specific_cart_product()
    {
        $user = User::factory()->create();

        $this->seed();

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $product = 1;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        $product = 3;
        $response = $this->actingAs($user)->post('/api/cart/products', [
            'product_id' => $product
        ]);

        // delete product (id = 3) from cart
        $productIdToDelete = 1;
        $response = $this->actingAs($user)->delete('/api/cart/products/' . $productIdToDelete);

        $response = $this->actingAs($user)->get('/api/cart/products');
        $response->assertJson([
            'total_quantity' => 2,
            'products'       => [
                [
                    'product_id' => 1,
                    'quantity'   => 1,
                ],
                [
                    'product_id' => 3,
                    'quantity'   => 1,
                ],
            ]
        ]);
    }

}
