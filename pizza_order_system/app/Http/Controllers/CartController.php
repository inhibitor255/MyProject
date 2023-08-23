<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // direct cart page
    public function cartPage()
    {
        return view('user.cart.cart');
    }
}
