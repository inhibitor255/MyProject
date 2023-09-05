<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();

        if (isset($data)) {
            Category::where('id', $request->id)->delete();
            return response()->json(["status" => true, "message" => "delete success", "data" => $data], 200);
        }
        return response()->json(["status" => false, "message" => "There is no category"], 404);
    }
}
