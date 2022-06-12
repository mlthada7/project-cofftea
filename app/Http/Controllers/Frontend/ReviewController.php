<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($slug)
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $product = Product::where('slug', $slug)->first();

        if ($product)
        {
            $productId = $product->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($review) 
            {
                return view('user.reviews.edit', [
                    'title' => 'Edit Product Review | Cofftea',
                    'cartCount' => $cartCount,
                    'review' => $review
                ]);
            }
            else {
                $verifiedPurchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.product_id', $productId);

                return view('user.reviews.index', [
                    'title' => 'Add Product Review | Cofftea',
                    'product' => $product,
                    'verifiedPurchase' => $verifiedPurchase,
                    'cartCount' => $cartCount
                ]);
            }
        }
        else {
            return redirect()->back()->with('status', 'Link Broken');
        }
    }

    public function create(Request $request)
    {
        $productId = $request->productId;
        $product = Product::where('id', $productId)->first();

        if ($product) {
            $userReview = $request->userReview;
            $addReview = Review::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'user_review' => $userReview
            ]);

            // $categorySlug = $product->category->slug;
            $productSlug = $product->slug;
            if ($addReview) {
                return redirect('/product/'.$productSlug)->with('status', 'Thankyou For Your Review on Our Product!');
            };
        }
        else {
            return redirect()->back()->with('status', 'Link Broken');
        }
    }

    public function edit($slug)
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $product = Product::where('slug', $slug)->first();

        if ($product) {
            $productId = $product->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($review) {
                return view('user.reviews.edit', [
                    'title' => 'Edit Product Review | Cofftea',
                    'cartCount' => $cartCount,
                    'review' => $review
                ]);
            }
            else {
                return redirect()->back()->with('status', 'link broken');
            }
        }
        else {
            return redirect()->back()->with('status', 'Link Broken');
        }
    }

    public function update(Request $request)
    {
        $userReview = $request->userReview;
        if ($userReview != null) {
            $reviewId = $request->reviewId;
            $review = Review::where('id', $reviewId)->where('user_id', Auth::id())->first();

            if ($review) {
                $review->user_review = $request->userReview;
                $review->update();

                $productSlug = $review->product->slug;
                return redirect('/product/' . $productSlug)->with('status', 'Your Review Has Been Successfully Updated!');
            }
            else {
                return redirect()->back()->with('status', 'Link Broken');
            }
        }
        else {
            return redirect()->back()->with('status', 'You Cannot Submit an Empty Review');
        }
    }
}
