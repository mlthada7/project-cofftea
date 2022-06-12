public function index()
{
$cartCount = Cart::where('user_id', Auth::id())->count();

return view('user.profile.index', [
'title' => 'User Profile',
'cartCount' => $cartCount
]);
}

public function edit(User $user)
{
$cartCount = Cart::where('user_id', Auth::id())->count();
// $user = Auth::id();

return view('user.profile.edit', [
'title' => 'Edit Profile',
// 'user' => $user,
'cartCount' => $cartCount
]);
}

public function update(Request $request)
{
$rules = [
'name' => 'required|max:255',
'email' => 'required|email|unique:users',
'phone' => 'numeric|max:12',
'address' => 'string',
'city' => 'string',
'zipcode' => 'numeric|max:6'
];

$validatedData = $request->validate($rules);

User::where('id', Auth::id())
->update($validatedData);

return redirect()->back()->with('success', 'Your Profile Has Been Succesfully Updated.');

}
{{-- @extends('user.layouts.main')

@section('container')

<div class="container-md mb-5 mt-5">

    <button id="pay-button">tes</button>

</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-yT1QXueTvZTCJ6DR"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endsection

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}');
// customer will be redirected after completing payment pop-up
});

</script> --}}

{{-- <html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SET_YOUR_CLIENT_KEY_HERE"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>
    <button id="pay-button">Pay!</button>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('TRANSACTION_TOKEN_HERE');
            // customer will be redirected after completing payment pop-up
        });

    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.88.1" />
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link href="https://getbootstrap.com/docs/5.1/examples/dashboard/" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    {{-- My CSS --}}
    <link rel="stylesheet" href="/css/style.css">

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-yT1QXueTvZTCJ6DR"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/js/jquery-3.6.0.min.js"></script>

</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top shadow-blur" aria-label="Fourth navbar example" style="background-color: #1F2937">
        <div class="container">
            <a class="navbar-brand fs-5 me-5" href="/">Cofftea</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsNav" aria-controls="navbarsNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsNav">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="/cart"><i class="bi bi-cart-dash"></i> <span class="badge bg-info badge-pill cart-count w-30">{{ $cartCount }}</span></a>
                    </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto me-0">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item {{ Request::is('profile/info*') ? 'active' : '' }}" href="/profile/info"><i class="bi bi-person-circle"></i> My Dashboard/profile</a></li>
                            <li><a class="dropdown-item {{ Request::is('my-orders') ? 'active' : '' }}" href="/my-orders"><i class="bi bi-layout-text-sidebar-reverse"></i> My Orders</a></li>
                            <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
                @else
                <li class="nav-item d-flex">
                    <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    <a href="/register" class="nav-link {{ Request::is('register') ? 'active' : '' }}"><i class="bi bi-box-arrow-up-right"></i> Register</a>
                </li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-md mb-5 mt-5 pt-5">
        {{-- <button id="pay-button">tes</button> --}}
        <button class=" w-75 btn btn-primary btn-lg" id="pay-button">Place Order</button>

    </div>

    <footer class="pb-4 pt-2 bg-dark mt-auto">
        <ul class="nav justify-content-center pt-3 pb-3 mb-3">
            <li class="nav-item"><a href="/" class="nav-link mx-2 link-light">Home</a></li>
            <li class="nav-item"><a href="" class="nav-link mx-2 link-light">Products</a></li>
            <li class="nav-item"><a href="" class="nav-link mx-2 link-light">About Us</a></li>
        </ul>
        <p class="text-center text-white-50">&copy; 2021 Company, Inc</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    <script src="/js/custom.js"></script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}');
            // customer will be redirected after completing payment pop-up
        });

    </script>
</body>
</html>
