<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $cartCount  = Cart::where('user_id', Auth::id())->count();
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(8)->withQueryString();

        return view('user.orders.index', [
            'title' => 'Order List | Cofftea',
            'cartCount' => $cartCount,
            'orders' => $orders
        ]);
    }

    public function viewOrder($id)
    {
        // return 'hello';
        $cartCount  = Cart::where('user_id', Auth::id())->count();

        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('user.orders.view', [
            'title' => 'Order Details | Cofftea',
            'cartCount' => $cartCount,
            'order' => $order
        ]);

    }
}
