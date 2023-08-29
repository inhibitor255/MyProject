<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct to list page
    public function listPage()
    {
        $orders = Order::orderBy('created_at', 'asc')->get();
        return view('admin.order.list', compact('orders'));
    }

    // status ajax
    public function ajaxStatus(Request $request)
    {

        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'asc');
        if ($request->status == null) {
            $orders = $orders->get();
        } else {
            $orders = $orders->where("status", $request->status)->get();
        }

        return response()->json($orders, 200);
    }
}
