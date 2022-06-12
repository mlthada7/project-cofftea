<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            return $next($request);
        }
        else {
            return redirect('/')->with('status', 'Add Product to Your Cart First');
        }
    }
}
