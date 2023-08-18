<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct user home page
    public function homePage()
    {
        $pizzas = Product::orderBy('updated_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('pizzas', 'categories'));
    }
}
