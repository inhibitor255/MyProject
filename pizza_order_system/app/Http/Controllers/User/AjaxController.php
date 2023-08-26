<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;

class AjaxController extends Controller
{
    // return pizza list with asc or desc
    public function pizzaList(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } elseif ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        return response()->json($data, 200);
    }

    // return pizza order list
    public function addCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Add to Cart is Complete'
        ], 200);
    }

    // order
    public function order(Request $request)
    {
        $total = 2000;
        foreach ($request->all() as $item) {
            $data = OrderList::create($item);
            $total += $data->total;
        }
        Cart::where('user_id', auth()->user()->id)->delete();
        Order::create([
            'user_id' => auth()->user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total,
        ]);
        return response()->json(['message' => 'Order success', 'status' => 'true'], 200);
    }

    // get order data
    private function getOrderData(Request $request)
    {
        return
            [
                'qty' => $request->qty,
                'user_id' => $request->userId,
                'product_id' => $request->productId,
            ];
    }
}
