<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.products.cart', [
            'title' => 'Shopping Cart | Cofftea',
            'items' => $cart,
            'cartCount' => $cartCount
        ]);
    }

    public function store(Request $request)
    {
        // $req->product_id dari key ajax
        $productId = $request->product_id;
        $productQty = $request->product_qty;

        if (Auth::check()) {
            $product = Product::where('id', $productId)->first();

            if ($product) {
                if (Cart::where('product_id', $productId)->where('user_id', Auth::user()->id)->exists()) {
                    return response()->json(['status' => $product->name . ' Is Already in Your Cart']);
                } 
                else {
                    $cartItem = new Cart();
                    // cartItem->product_id => field db
                    $cartItem->product_id = $productId;
                    $cartItem->user_id = Auth::user()->id;
                    $cartItem->product_qty = $productQty;
                    $cartItem->save();
                    return response()->json(['status' => $product->name . ' Has Been Added to Your Cart']);
                }
            }

        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }


    public function update(Request $request)
    {
        $productId = $request->product_id;
        $productQty = $request->product_qty;

        // dd($productQty);
        // $cart = Cart::where('product_id', $productId)->where('user_id', Auth::user()->id);

        if (Auth::check()) 
        {
            if (Cart::where('product_id', $productId)->where('user_id', Auth::id())->exists()) 
            {
                $cartItem = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();
                $cartItem->product_qty = $productQty;
                $cartItem->update();
                // $cartItem->update([
                //     'product_qty' => $productQty

                // ]);
                // Product::where('id', $product->id)
                // ->update($validatedData);
                return response()->json(['status' => 'updated']);
            }
        } 
        else 
        {
            return response()->json(['status' => 'Login to Continue']);
        }
    }
        

    public function delete(Request $request)
    {
        $productId = $request->product_id;

        if (Auth::check()) 
        {
            $cartItem = Cart::where('product_id', $productId)->where('user_id', Auth::user()->id);
            if ($cartItem->exists()) 
            {
            $cartItem->first()->delete();
                return response()->json(['status' => 'Product Has Been Deleted From Your Cart']);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }

    public function cartcount(){
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartCount]);
    }
}
