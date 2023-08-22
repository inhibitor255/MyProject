<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function pizzaList(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } elseif ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        return $data;
    }
}
