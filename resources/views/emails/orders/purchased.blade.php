@component('mail::message')
# Introduction

Order purchased!
@php
$totalPrice = '$' . number_format($cart['total_price'], 2);
@endphp

{{ 'Total Items: ' . $cart['total_quantity'] }} <br/>
{{ 'Total Price: ' . $totalPrice }} <br/>


@component('mail::table')
| Product       | Price         | Quantity  |
| ------------- |:-------------:| --------:|
@foreach ($cart['products'] as $product)
@php
$price = '$' . number_format($product->price, 2);
@endphp
| {{ $product->name }}      | {{ $price }}      | {{ $product->quantity }}      |
@endforeach
@endcomponent

@component('mail::button', ['url' => ''])
View more
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
