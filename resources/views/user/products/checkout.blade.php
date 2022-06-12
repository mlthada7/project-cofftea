@extends('user.layouts.main')

@section('container')
{{-- @dd($items); --}}
{{-- @if($items->count() > 0) --}}
<div class="container-md mb-5 mt-5">
    <main>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <a href="/cart" class="btn btn-outline-secondary"><i class="fas fa-angle-left me-1"></i> Your Cart</a>
                    {{-- <span class="text-primary">Your cart</span> --}}
                    <span class="badge bg-primary badge-pill">{{ $cartCount }}</span>
                </h4>
                @if(count($items))

                {{-- <div class="card shadow-sm">
                    <div class="card-body"> --}}
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach ($items as $item)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="d-flex flex-column">
                            <h6 class="my-0 pb-2 fw-bold">{{ $item->product->name }}</h6>
                            <small class="text-muted pb-1">{{ $item->product_qty }} Item(s)</small>
                            <small class="fw-normal">Rp{{ $item->product->selling_price }}</small>
                        </div>
                        <span class="fw-normal">Rp{{ $item->product->selling_price * $item->product_qty}}</span>
                    </li>
                    @php $total += $item->product->selling_price * $item->product_qty; @endphp
                    {{-- <p>{{ $total }}</p> --}}
                    @endforeach
                    @php
                    $ongkir = 20000
                    @endphp
                    <li class="list-group-item d-flex flex-column p-3">
                        <div class="d-flex justify-content-between border-bottom">
                            <span class="text-muted pb-2">Shipping Fee </span>
                            <span>Rp{{ $ongkir }}</span>
                        </div>
                        <div class="d-flex justify-content-between pt-3">
                            <span>Total </span>
                            <strong>Rp{{ $total += $ongkir }}</strong>
                            {{-- <strong>Rp{{ $total }}</strong> --}}
                        </div>
                    </li>
                </ul>
                @else
                <p>No Product Found</p>
                @endif



                {{-- </div>
                </div> --}}

            </div>

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-4">Shipping Details</h4>
                <form class="needs-validation" action="" method="" autocomplete="off" id="checkout_form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-10">
                            <label for="name" class="form-label">Fullname</label>
                            <input type="text" class="form-control name @error('name')
                                is-invalid
                            @enderror" id="name" name="name" value="{{ $user->name }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control email" id="email" name="email" placeholder="you@example.com" value="{{ $user->email }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="phone" class="form-label">Phone Number <span class="text-muted"></span></label>
                            <input type="number" class="form-control phone" id="phone" name="phone" placeholder="08xxxxxxxxxx" value="{{ $user->phone }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid phone number for shipping updates.
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control address" id="address" name="address" placeholder="1234 Main St" required>{{ $user->address }}</textarea>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-6">
                            <label for="city" class="form-label">City<span class="text-muted"></span></label>
                            <select class="form-select" name="city" id="city">
                                <option value=" {{ old('city', $user->city) == '' ? 'selected' : ''}}"></option>
                                <option value="Jakarta Utara" {{ old('city', $user->city) == "Jakarta Utara" ? 'selected' : ''}}>Jakarta Utara</option>
                                <option value="Jakarta Pusat" {{ old('city', $user->city) == "Jakarta Pusat" ? 'selected' : ''}}>Jakarta Pusat</option>
                                <option value="Jakarta Barat" {{ old('city', $user->city) == "Jakarta Barat" ? 'selected' : ''}}>Jakarta Barat</option>
                                <option value="Jakarta Timur" {{ old('city', $user->city) == "Jakarta Timur" ? 'selected' : ''}}>Jakarta Timur</option>
                                <option value="Jakarta Selatan" {{ old('city', $user->city) == "Jakarta Selatan" ? 'selected' : ''}}>Jakarta Selatan</option>
                            </select>
                            {{-- <input type="text" class="form-control city" id="city" name="city" placeholder="" value="{{ $user->city }}" required> --}}
                            <div class="invalid-feedback">
                                Please enter a valid City number for shipping updates.
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-5">
                            <label for="zipcode" class="form-label">Zipcode</label>
                            <input type="number" class="form-control w-50 zipcode" id="zipcode" name="zipcode" placeholder="12850" value="{{ $user->zipcode }}" size="5" required>
                            <div class="invalid-feedback">
                                Please enter a valid zipcode address for shipping updates.
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- <h5 class="my-0">Delivery</h5>
                        <div class="my-3">
                            <div class="form-check">
                                <input class="form-check-input addShippingFee" type="radio" name="delivery" id="jne" required>
                                <label class="form-check-label" for="jne">
                                    JNE Reguler - Rp15.000
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input addShippingFee" type="radio" name="delivery" id="anteraja" required>
                                <label class="form-check-label" for="anteraja">
                                    AnterAja - Rp16.000
                                </label>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <hr class="my-4"> --}}

                    {{-- <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                    </div> --}}

                    {{-- <hr class="my-4"> --}}

                    <button class="w-75 btn btn-primary btn-lg" type="submit">Place Order</button>
                </form>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

<script>
    $('#checkout_form').submit(function(e) {
        e.preventDefault();

        $.post("/place-order", {
                _method: 'POST'
                , _token: '{{ csrf_token() }}'
                , name: $('input#name').val()
                , email: $('input#email').val()
                , phone: $('input#phone').val()
                , address: $('textarea#address').val()
                , city: $('select#city').val()
                , zipcode: $('input#zipcode').val()
                    // , delivery: $('input#delivery').val();
            , }
            , function(data, status) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert("payment success!");
                        location.replace('/');
                    }
                    , onPending: function(result) {
                        alert("Order Success, waiting your payment!");
                        window.location.replace("/my-orders");
                    }
                    , onError: function(result) {
                        alert("payment failed!");
                        location.replace('/');
                    }
                    , onClose: function() {
                        alert('Order Success, Please finish the payment later.');
                        window.location.replace("/my-orders");
                    }
                })
            }
        );
    });

</script>

@endsection
