<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct product list page
    public function list()
    {
        $pizzas = Product::latest('updated_at')->paginate(5);
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    // direct product create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // create product
    public function create(Request $request)
    {
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#listPage')->with('createMessage', 'Created Successfully.');
    }

    // product validation check
    private function productValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                "name" => "required|min:5|unique:products,name",
                "category" => "required",
                "description" => "required|min:10",
                "price" => "required",
                "waitingTime" => "required",
                "image" => "required|mimes:png,jpg,jpeg,webp|file",
            ],
            []
        )->validate();
    }

    // request product info
    private function requestProductInfo($request)
    {
        return
            [
                "name" => $request->name,
                "category_id" => $request->category,
                "description" => $request->description,
                "price" => $request->price,
                "waiting_time" => $request->waitingTime,
            ];
    }
}
