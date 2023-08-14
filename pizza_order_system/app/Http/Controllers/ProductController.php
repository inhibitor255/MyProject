<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    // direct product list page with paginate and search data
    public function list(Request $request)
    {
        $pizzas = Product::when(request('searchData'), function ($query) {
            $searchData = request('searchData');
            $query->where('name', 'Like', '%' . $searchData . '%');
        })
            ->latest('updated_at')
            ->paginate(3);
        $pizzas->appends($request->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    // direct product create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // direct product detail page
    public function detailPage($id)
    {
        $detailData = Product::where('id', $id)->first();
        return view('admin.product.detail', compact('detailData'));
    }

    // direct product edit page
    public function editPage($id)
    {
        $editData = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('editData'));
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

    // edit product
    public function edit(Request $request)
    {
        dd($request);
    }

    // delete product
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product#listPage')->with('deleteMessage', 'Pizza was successfully deleted.');
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
