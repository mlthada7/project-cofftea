<?php

namespace App\Http\Controllers\Frontend;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\User;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Akan dijalankan ketika method di controller dipanggil
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();

        $user = User::where('id', Auth::id())->first();

        // $old_cartItem = Cart::where('user_id', Auth::id())->get();
        // foreach ($old_cartItem as $item) {
        //     if (!Product::where('id', $item->product_id)->where('qty', '>=', $item->product_qty)->exists())
        //     {
        //         $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
        //         $removeItem->delete();
        //     };

        //     $cartItem = Cart::where('user_id', Auth::id())->get();

        //     dd($cartItem);

        //     // $cartItem = Cart::where('user_id', Auth::id())->first();
        //     // if ($cartItem != null) {
        //     //     $getCartItem = Cart::where('user_id', Auth::id())->get();
        //     // }
        //     // else {
        //     //     $getCartItem = Cart::where('user_id', Auth::id())->first();
        //     // }
            

        // }

        $cartItem = Cart::where('user_id', Auth::id())->get();
        // dd($cartItem);


        // @dd($cartItem);
        // @dd($getCartItem);
        
        return view('user.products.checkout', [
            'title' => 'Checkout Product | Cofftea Administrator',
            'cartCount' => $cartCount,
            // 'itemsss' => $getCartItem,
            'items' => $cartItem,
            'user' => $user
        ]);
    }

    public function placeOrder(Request $request)
    {
        // dd($request->all());
        // $rules = [
        //     'name' => 'required|max:255',
        //     'email' => 'required',
        //     'phone' => 'required|numeric',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'zipcode' => 'required|numeric',
        // ]);

        // Order::create($validatedData)

        // Mencegah data disimpan jika ada kesalahan
        // dd()
        DB::transaction(function () use ($request){
            $totalPrice = 0;
            $cartItems = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItems as $item ) {
                $totalPrice += $item->product->selling_price * $item->product_qty;
            }

            $ongkir = 20000;
            $totalPrice += $ongkir;
            // $order->total_price = $totalPrice;

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'total_price' => $totalPrice,
                // 'delivery' => $request->delivery,
                'tracking_num' => '#ID' . uniqid()
            ]);

            // dd($order);

            $params = [    
                'transaction_details' => [
                    'order_id' => $order->tracking_num,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                    'billing_address'=> [
                        'address' => $order->address,
                        'city' => $order->city,
                        'postal_code' => $order->zipcode,
                        'country_code' => 'IDN'
                    ],
                ],
            ];
            
            // dd($params);
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $order->snap_token = $snapToken;
            $order->save();

            $cartItem = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItem as $item) 
            {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->product_qty,
                    'price' => $item->product->selling_price
                ]);

                // Update Product Qty In DB
                $product = Product::where('id', $item->product->id)->first();
                $product->qty -= $item->product_qty;
                $product->update();
            }

            Cart::destroy($cartItem);

            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
        
        // Order form
        // $order = new Order();
        // $order->user_id = Auth::id();
        // $order->name = $request->name;
        // $order->email = $request->email;
        // $order->phone = $request->phone;
        // $order->address = $request->address;
        // $order->city = $request->city;
        // $order->zipcode = $request->zipcode;

        // Calculate total_price
        // $totalPrice = 0;
        // $cartItems = Cart::where('user_id', Auth::id())->get();
        // foreach ($cartItems as $item ) {
        //     $totalPrice += $item->product->selling_price * $item->product_qty;
        // }
        // $order->total_price = $totalPrice;
        
        // $order->tracking_num = '#'.rand(1111,9999);
        // $order->save();

        // dd($order);

        // Ambil isi cart
        // $cartItem = Cart::where('user_id', Auth::id())->get();
        // foreach ($cartItem as $item) 
        // {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $item->product_id,
        //         'qty' => $item->product_qty,
        //         'price' => $item->product->selling_price
        //     ]);

        //     $product = Product::where('id', $item->product->id)->first();
        //     $product->qty -= $item->product_qty;
        //     $product->update();
        // }

        // if (Auth::user()->address == null) {
        //     $user = User::where('id', Auth::id())->first();
        //     $user->name = $request->name;
        //     $user->email = $request->email;
        //     $user->phone = $request->phone;
        //     $user->address = $request->address;
        //     $user->city = $request->city;
        //     $user->zipcode = $request->zipcode;
        //     $user->update();
        // }

        // Cart::destroy($cartItem);

        
        // return redirect('/')->with('statusPlaceOrder', 'Order berhasil dilakukan! Terimakasih!');

    }

    // public function midtransNotif()
    // {
    //     $notif = new \Midtrans\Notification();
    //     DB::transaction(function () use ($notif) {
    //         $transactionStatus = $notif->transaction_status;
    //         $paymentType = $notif->payment_type;
    //         $orderId = $notif->order_id;
    //         $fraudStatus = $notif->fraud_status;
    //         $order = Order::where('tracking_num', $orderId)->first();

    //         if ($transactionStatus == 'capture') {
    //             if ($paymentType == 'credit_card') {
    //                 if ($fraudStatus == 'challenge') {
    //                     $order->setStatusPending();
    //                 } else {
    //                     $order->setStatusSuccess();
    //                 }
    //             }
    //             elseif ($transactionStatus == 'settlement') {
    //                 $order->setStatusSuccess();
    //             }
    //             elseif ($transactionStatus == 'pending') {
    //                 $order->setStatusPending();
    //             }
    //             elseif ($transactionStatus == 'deny') {
    //                 $order->setStatusFailed();
    //             }
    //             elseif ($transactionStatus == 'expire') {
    //                 $order->setStatusExpired();
    //             }
    //             elseif ($transactionStatus == 'cancel') {
    //                 $order->setStatusFailed();
    //             }
    //         }
    //     });
    //     return;
    // }

    public function paymentGateway(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItem as $item) {
            $total_price += $item->product->selling_price * $item->product_qty;
        }
        
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $city = $request->city;
        $zipcode = $request->zipcode;

        return response()->json([
            'name'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'address'=> $address,
            'city'=> $city,
            'zipcode'=> $zipcode,
            'total_price'=> $total_price,

        ]);
        
        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = 'Mid-server-9coJM8JDtXgZ0JH0xKAkCSU-';
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;
        // $params = array(    
        //     'transaction_details' => array(        
        //         'order_id' => rand(),        
        //         'gross_amount' => 10000,    
        //     ),    
        //     'customer_details' => array(        
        //         'first_name' => 'budi',        
        //         'last_name' => 'pratama',        
        //         'email' => 'budi.pra@example.com',        
        //         'phone' => '08111222333',    
        //     ),
        // ); 
        
        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // // dd($snapToken);

        // return view('user.products.tes', [
        //     'title' => 'Payment',
        //     'snapToken' => $snapToken
        // ]);

    }
}
