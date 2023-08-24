<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // direct cart page
    public function cartPage()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $cartTotalPrice = 0;
        foreach ($carts as $c) {

            $cartTotalPrice += $c->qty * $c->product->price;
        }
        return view('user.cart.cart', compact('carts', 'cartTotalPrice'));
    }
}
