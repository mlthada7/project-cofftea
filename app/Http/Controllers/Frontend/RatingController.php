<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $starsRated = $request->product_rating;
        $productId = $request->product_id;
        $productCheck = Product::where('id', $productId)->first();
        
        if($productCheck)
        {
            $verifiedPurchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.product_id', $productId);

                // dd($verifiedPurchase);

            if ($verifiedPurchase->count() > 0)
            {
                $ratingExist = Rating::where('user_id', Auth::id())->where('product_id', $productId)->first();
                if ($ratingExist)
                {
                    $ratingExist->stars_rated = $starsRated;
                    $ratingExist->update();
                }
                else {
                    $rating = Rating::create([
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'stars_rated' => $starsRated
                    ]);
                    $rating->save();    
                }
                return redirect()->back()->with('status', 'Your Rating Has Been Saved');
            }
            else {
                return redirect()->back()->with('status', 'You Cannot Rate a Product Without Purchasing First');
            }
        }
        else {
            return redirect()->back()->with('status', 'Link Broken');
        }
    }
}
