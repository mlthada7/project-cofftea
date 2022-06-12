public function index()
{
$user = Auth::user();
// $restore = Cart::restore($user);
// dd($restore);
$items = Cart::instance($user)->content();
return view('user.cart', [
'title' => 'cart',
'items' => $items
]);
}

public function addCart(Request $request)
{
$product = Product::findOrFail($request->id);

// if($product->id !== auth()->user()->id) {
// abort(403);
// }

$user = Auth::user();
Cart::instance($user)->add(
$product->id,
$product->name,
$request->quantity,
$product->selling_price
);

// Cart::store($user);

// dd($cart);
return redirect()->back()->with('success', 'Product has been added to cart!');

}

public function update(Request $request)
{
Cart::update($request->rowId, $request->quantity);
}

public function remove(Request $request)
{
// $item = Cart::get($rowId);
// dd($request->rowId);
Cart::remove($request->rowId);

return redirect()->route('cartlist')->with('successRemove', 'Item has been removed!');
}

public function destroy()
{
Cart::destroy();

return redirect()->back()->with('success', 'Your cart has been clear!');
}
