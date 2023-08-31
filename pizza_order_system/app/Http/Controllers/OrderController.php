<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
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
    public function changeStatus(Request $request)
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'asc');
        if ($request->status == null) {
            $orders = $orders->get();
        } else {
            $orders = $orders->where("status", $request->status)->get();
        }
        return view('admin.order.list', compact('orders'));
    }

    // sub status change
    public function ajaxStatusChange(Request $request)
    {
        logger($request->all());
        Order::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json('status change successfully', 200);
    }

    // order list info
    public function listInfo($orderCode)
    {
        $orderLists = OrderList::where('order_code', $orderCode)->get();
        $order = Order::where('order_code', $orderCode)->first();
        return view('admin.order.orderList', compact('orderLists', 'order'));
    }
}
