<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category list page
    public function list(Request $request)
    {
        $categories = Category::when(request('searchData'), function ($query) {
            $searchData = request('searchData');
            $query->where('name', 'Like', '%' . $searchData . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $categories->appends($request->all());
        return view('admin.category.list', compact('categories'));
    }

    // direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(["createMessage" => "Category Creation is successful."]);
    }

    // delete category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(["deleteMessage" => "Category Deletion is successful."]);
    }

    // category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required| unique:categories,name',
            ],
            [
                'name.required' => 'အမျိုးအစား အမည်ဖြည့်ရန်လိုအပ်ပါသည်။',
                'name.unique' => 'အမည်တူအမျိုးအစားရှိနေပါသည်။ မတူအောင်ဖြည့်ပါ။'
            ]
        )->validate();
    }

    // request category data
    private function requestCategoryData($request)
    {
        return
            [
                'name' => $request->name,
            ];
    }
}
