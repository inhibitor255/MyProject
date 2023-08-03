<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        // direct category list page
        return view('admin.category.list');
    }
}
