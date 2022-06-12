<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cityList = ['Jakarta', 'Bandung'];
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $user = User::where('id', Auth::id())->first();
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(8)->withQueryString();
        // return 'hello';

        return view('user.profile.index', [
            'title' => 'User Profile | Cofftea',
            'user' => $user,
            'orders' => $orders,
            'cartCount' => $cartCount,
            // 'cityList' => $cityList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        $user = User::where('id', Auth::id())->first();

        return view('user.profile.edit', [
            'title' => 'Edit Profile | Cofftea',
            'user' => $user,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::where('id', Auth::id())->first();
        $rules = [
            'name' => 'required|string|regex:/^[a-zA-Z ]*$/|min:4',
            // 'email' => 'required|email|unique:users',
            'phone' => 'nullable|numeric|digits_between:6,12',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'zipcode' => 'nullable|numeric|digits:5'
            ];

            if ($request->email != $user->email) {
                $rules['email'] = 'required|email:dns|unique:users';
            }

            // dd($rules);

            $validatedData = $request->validate($rules);
            
            User::where('id', $user->id)
            ->update($validatedData);
            
            return redirect('/profile')->with('success', 'Your Profile Has Been Succesfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
