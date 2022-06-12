<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = Order::where('status', '0')->get();
        $orders = Order::orderBy('updated_at', 'DESC')->get();
        return view('admin.orders.index', [
            'title' => 'Order List | Cofftea Administrator',
            'orders' => $orders
        ]);
    }

    public function view($id)
    {
        $order = Order::where('id', $id)->first();
        return view('admin.orders.view', [
            'title' => 'Order Details | Cofftea Administrator',
            'order' => $order

        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->orderStatus;
        $order->update();

        return redirect('/dashboard/orders')->with('success', 'Order Status Has Been Successfully Updated!');
    }

    public function orderListAjax()
    {
        $orders = Order::select('tracking_num')->get();
        $data = [];

        foreach ($orders as $order) {
            $data[] = $order['tracking_num'];
        }

        return $data;
    }

    public function searchOrder(Request $request)
    {
        $searched_order = $request->searchID;
        if ($searched_order != '') 
        {
            $order = Order::where('tracking_num', 'LIKE', '%' . $searched_order . '%')->first();
            if ($order) {
                return redirect('/dashboard/orders/' . $order->id);
            }
            else {
                return redirect()->back()->with('status', 'No Order Matched Your Search');
            }
        }
        else {
            return redirect()->back();
        }
    }
}
