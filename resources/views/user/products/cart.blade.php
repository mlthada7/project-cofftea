@extends('user.layouts.main')

@section('container')

{{-- @dd($items) --}}

<section class="py-4 min-vh-100">
    @if(session()->has('status'))
    <script>
        swal("{{ session('status') }}");

    </script>
    @endif

    <div class="container py-2 cartItems pt-3">
        @if($items->count())
        <p class="lead mb-3 border rounded-3 p-3 bg-secondary text-light fw-light">You currently have <span class="fw-bold">{{ $cartCount }}</span>
            item(s) in your cart.</p>
        {{-- Product Data --}}
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="h5 fw-bold">Shopping Cart</th>
                                        <th scope="col" class="h5 fw-normal text-center">Quantity</th>
                                        <th scope="col" class="h5 fw-normal text-center">Unit Price</th>
                                        <th scope="col" class="h5 fw-normal text-center">Total</th>
                                        <th scope="col" class="h5 fw-normal text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($items as $item)
                                    {{-- @dd($item->products->name); --}}
                                    <tr class="product-data">
                                        <td class="">
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded-3" style="width: 120px;" alt="{{ $item->product->name }}">
                                                @else
                                                <img src="https://source.unsplash.com/500x500?{{ $item->product->name }}" class="img-fluid rounded-3" style="width: 120px;" alt="{{ $item->product->name }}">
                                                @endif
                                                <div class="flex-column ms-4">
                                                    <p class="mb-2">{{ $item->product->name }}</p>
                                                    <p class="mb-0 text-muted">{{ $item->product->meta_description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-row justify-content-center">
                                                <input type="hidden" class="product-id" value="{{ $item->product_id }}">
                                                @if($item->product->qty >= $item->product_qty)
                                                <div class="input-group mb-3">
                                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                                    <input type="number" class="form-control qty-input" name="quantity" value="{{ $item->product_qty }}" id="quantity" style="width: 45px">
                                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                                    @php $total += $item->product->selling_price * $item->product_qty; @endphp
                                                </div>
                                                @else
                                                <p class="text-muted">Out of stock</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="mb-0" style="font-weight: 500;">Rp{{ $item->product->selling_price }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="mb-0" style="font-weight: 500;">Rp{{ $item->product->selling_price * $item->product_qty }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="badge bg-danger border-0 delete-btn" type="submit"><i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- NAVIGATION FOOTER-->
                        <div class="row gx-lg-0 bg-light px-2 py-2 text-center">
                            <div class="col-6 text-md-start py-1">
                                <a class="btn btn-outline-secondary my-1" href="/"><i class="fas fa-angle-left me-1"></i> Continue Shopping</a>
                            </div>
                            <div class="col-6 text-end py-1">
                                <a href="/checkout" class="btn btn-primary my-1" type="submit">Proceed to Checkout <i class="fas fa-angle-right ms-1"></i></a>
                                {{-- <button class="btn btn-outline-danger my-1" type="submit">Clear Cart <i class="fas fa-angle-right ms-1"></i></button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHECKOUT SIDEBAR [ORDER SUMMARY]-->
            <div class="col-lg-4 mb-5 order-last">
                <div class="card shadow-sm bg-light">
                    <div class="card-body py-4 px-3">
                        <h5 class="card-title text-uppercase mb-3">Order summary</h5>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody class="text-sm">
                                    <tr>
                                        <th class="text-muted"><span class="d-block py-1 fw-normal">Subtotal</span></th>
                                        <th><span class="d-block py-1 fw-normal text-end">Rp{{ $total }}</span></th>
                                    </tr>
                                    @php
                                    $ongkir = 20000
                                    @endphp
                                    <tr>
                                        <th class="text-muted"><span class="d-block py-1 fw-normal">Shipping</span></th>
                                        <th><span class="d-block py-1 fw-normal text-end">Rp{{ $ongkir }}</span></th>
                                    </tr>
                                    {{-- <tr>
                                        <th class="text-muted"><span class="d-block py-1 fw-normal">Tax</span></th>
                                        <th><span class="d-block py-1 fw-normal text-end">Rp</span></th>
                                    </tr> --}}
                                    <tr class="total">
                                        <td class="py-3 border-bottom-0 text-muted"><span class="lead fw-bold">Total</span></td>
                                        <th class="py-3 border-bottom-0 text-end"><span class="lead fw-bold">Rp{{ $total += $ongkir }}</span></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center fs-4 py-5 my-5">
            <p>Your cart is empty</p>
            <a href="/" class="btn btn-primary">Shop Now!</a>
        </div>
        @endif
    </div>
</section>


@endsection


{{-- <section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Shopping Bag</th>
                                <th scope="col">Format</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.imgur.com/2DsA49b.webp" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                                        <div class="flex-column ms-4">
                                            <p class="mb-2">Thinking, Fast and Slow</p>
                                            <p class="mb-0">Daniel Kahneman</p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;">Digital</p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-row">
                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" style="width: 50px;" />

                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;">$9.99</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.imgur.com/Oj1iQUX.webp" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                                        <div class="flex-column ms-4">
                                            <p class="mb-2">Homo Deus: A Brief History of Tomorrow</p>
                                            <p class="mb-0">Yuval Noah Harari</p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle border-bottom-0">
                                    <p class="mb-0" style="font-weight: 500;">Paperback</p>
                                </td>
                                <td class="align-middle border-bottom-0">
                                    <div class="d-flex flex-row">
                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-sm" style="width: 50px;" />

                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle border-bottom-0">
                                    <p class="mb-0" style="font-weight: 500;">$13.50</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                                <form>
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v" value="" aria-label="..." checked />
                                        </div>
                                        <div class="rounded border w-100 p-3">
                                            <p class="d-flex align-items-center mb-0">
                                                <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Credit
                                                Card
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2v" value="" aria-label="..." />
                                        </div>
                                        <div class="rounded border w-100 p-3">
                                            <p class="d-flex align-items-center mb-0">
                                                <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debit Card
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel3v" value="" aria-label="..." />
                                        </div>
                                        <div class="rounded border w-100 p-3">
                                            <p class="d-flex align-items-center mb-0">
                                                <i class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>PayPal
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-6">
                                <div class="row">
                                    <div class="col-12 col-xl-6">
                                        <div class="form-outline mb-4 mb-xl-5">
                                            <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="John Smith" />
                                            <label class="form-label" for="typeName">Name on card</label>
                                        </div>

                                        <div class="form-outline mb-4 mb-xl-5">
                                            <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YY" size="7" id="exp" minlength="7" maxlength="7" />
                                            <label class="form-label" for="typeExp">Expiration</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-outline mb-4 mb-xl-5">
                                            <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1111 2222 3333 4444" minlength="19" maxlength="19" />
                                            <label class="form-label" for="typeText">Card Number</label>
                                        </div>

                                        <div class="form-outline mb-4 mb-xl-5">
                                            <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                            <label class="form-label" for="typeText">Cvv</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <div class="d-flex justify-content-between" style="font-weight: 500;">
                                    <p class="mb-2">Subtotal</p>
                                    <p class="mb-2">$23.49</p>
                                </div>

                                <div class="d-flex justify-content-between" style="font-weight: 500;">
                                    <p class="mb-0">Shipping</p>
                                    <p class="mb-0">$2.99</p>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                    <p class="mb-2">Total (tax included)</p>
                                    <p class="mb-2">$26.48</p>
                                </div>

                                <button type="button" class="btn btn-primary btn-block btn-lg">
                                    <div class="d-flex justify-content-between">
                                        <span>Checkout</span>
                                        <span>$26.48</span>
                                    </div>
                                </button>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section> --}}

{{-- <tr>
    <td>
        <div class="d-flex align-items-center">
            <img src="https://i.imgur.com/2DsA49b.webp" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
            <div class="flex-column ms-4">
                <p class="mb-2">Thinking, Fast and Slow</p>
                <p class="mb-0 text-muted">Daniel Kahneman</p>
            </div>
        </div>
        </th>
    <td class="align-middle text-center">
        <div class="d-flex flex-row">
            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                <i class="fas fa-minus"></i>
            </button>

            <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" style="width: 50px;" />

            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </td>
    <td class="align-middle text-center">
        <p class="mb-0" style="font-weight: 500;">$9.99</p>
    </td>
    <td class="align-middle text-center">
        <p class="mb-0" style="font-weight: 500;">$9.99</p>
    </td>
    <td class="align-middle text-center">
        <button class="btn btn-link p-0" type="button"><i class="bi bi-trash"></i></button>
    </td>
</tr> --}}

{{-- <div class="d-flex flex-row justify-content-center">
                                        <button class="btn btn-link px-2" class="changeQty" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="bi bi-dash-circle-fill"></i>
                                        </button>
                                        <input id="quantity" min="1" name="quantity" value="{{ $item->product_qty }}" type="number" class="form-control form-control-sm text-center qty-input" style="width: 50px;" />
<button class="btn btn-link px-2" class="changeQty" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
    <i class="bi bi-plus-circle-fill"></i>
</button>
</div> --}}
