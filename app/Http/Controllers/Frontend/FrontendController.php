<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return view('user.products.home', [
            'title' => 'Cofftea Homepage',
            'cartCount' => $cartCount,
            // 'products' => Product::latest()->get()
            'products' => Product::latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString(),
            'trProducts' => Product::all()
        ]);
    }

    public function find()
    {
        $header = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $header = "All " . $category->name . ' Products';
        }

        $cartCount = Cart::where('user_id', Auth::id())->count();

        return view('user.products.result', [
            'title' => $header . ' Cofftea',
            'header' => $header,
            'products' => Product::latest()->filter(request(['search', 'category']))->paginate(8)->withQueryString(),
            'categories' => Category::all(),
            'cartCount' => $cartCount,
        ]);
    }

    public function kategori(){
        $cartCount = Cart::where('user_id', Auth::id())->count();

        return view('user.products.categories', [
            'title' => 'All Categories | Cofftea',
            'categories' => Category::all(),
            'cartCount' => $cartCount,
        ]);
    }

    public function viewProduct(Product $product)
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $ratings = Rating::where('product_id', $product->id)->get();
        $rating_sum = Rating::where('product_id', $product->id)->sum('stars_rated');
        $user_rating = Rating::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        $reviews = Review::where('product_id', $product->id)->get();

        if ($ratings->count() > 0) {
            $ratingValue = $rating_sum/$ratings->count();
        }
        else {
            $ratingValue = 0;
        }

        return view('user.products.product', [
            'title' => $product->name,
            'product' => $product,
            'cartCount' => $cartCount,
            'ratings' => $ratings,
            'ratingValue' => $ratingValue,
            'userRating' => $user_rating,
            'reviews' => $reviews
        ]);
    }

    public function about(){
        $cartCount = Cart::where('user_id', Auth::id())->count();

        return view('user.about', [
            'title' => 'About Cofftea | Cofftea',
            'cartCount' => $cartCount
        ]);
    }

    public function tesSnap()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Xs3QBZPuMEsZVj2tiXNoNNdI';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction)
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true; 
        $params = array(    
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        ); 
            
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // return $snapToken;

        return view('user.products.tessnap', [
            'snap' => $snapToken
        ]);
    }
}
