<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class RouteController extends Controller
{

    // show category
    public function showCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            Category::where('id', $request->id)->first();
            return response()->json(["status" => true, "message" => "success", "data" => $data], 200);
        }
        return response()->json(["status" => false, "message" => "There is no category"], 404);
    }

    // update category
    public function updateCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            Category::where('id', $request->id)->update([
                "name" => $request->name,
            ]);
            $updateData = Category::where('id', $request->id)->first();
            return response()->json(["status" => true, "message" => "success", "data" => $updateData], 200);
        }
        return response()->json(["status" => false, "message" => "There is no category"], 404);
    }

    // delete category
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            Category::where('id', $request->id)->delete();
            return response()->json(["status" => true, "message" => "success", "data" => $data], 200);
        }
        return response()->json(["status" => false, "message" => "There is no category"], 404);
    }

    private function categoryValidation(Request $request,)
    {
    }
}
