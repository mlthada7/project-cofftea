@extends('user.layouts.sidebar')

@section('content')

{{-- @if($orders->count()) --}}
{{-- <section class="py-4 min-vh-100"> --}}
@if(session()->has('status'))
<script>
    swal("{{ session('status') }}");

</script>
@endif

{{-- <div class="container py-2"> --}}
{{-- <p class="text-muted lead mb-5">You currently have <span class="fw-bold">{{ $cartCount }}</span>
item(s) in your cart.</p> --}}

{{-- Product Data --}}
{{-- <div class="row"> --}}
<div class="col-10 col-sm-9 col-md-9 col-lg-9 col-xl-10">
    <div class="card card__shadow my-4 pb-4">
        <div class="card-header pb-4">
            <h1 class="fs-4 fw-bold d-inline">Order Details</h1>
            <a href="/my-orders" class="btn btn-outline-primary float-end"><i class="fas fa-angle-left me-1"></i> Back</a>
        </div>

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-8 col-md-6 ms-4 fw-bold text-light" role="alert"><i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- @if($products->count()) --}}
        <div class="card-body px-4 py-3 min-vh-70 d-lg-flex justify-content-lg-between">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="card card__shadow">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between">
                            <p class="">Status : <span class="me-3 fw-bold">{{ $order->status }}</span></p>
                            <p class="">Tracking Num : <span class="me-3">{{ $order->tracking_num }}</span></p>
                            <p class="">Order Date : <span class="me-3">{{ date('d-M-Y', strtotime($order->created_at)) }}</span></p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="card card__shadow">
                    <div class="card-body">
                        <h5 class="card-title">Shipping Details</h5>
                        <hr>
                        <div class="d-flex flex-column justify-content-between">
                            <p class="text-start">Name : <span class="fw-bold">{{ $order->name }}</span></p>
                            <p class="text-start">Phone : <span class="">{{ $order->phone }}</span></p>
                            <div class="d-flex flex-row justify-content-start">
                                <p class="pe-2">Address <span class="">:</span></p>
                                <p class="text-start">
                                    {{ $order->address }}<br>
                                    {{ $order->city }}
                                    {{ $order->zipcode }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                @php
                $ongkir = 20000;
                @endphp
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between pb-3">
                        <span class="text-muted ps-3">Shipping Fee :</span>
                        <span class="text-start pe-3">Rp{{ $ongkir }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fw-bolder ps-3">Total Price <span class="">:</span></p>
                        <span class="text-start pe-3 fw-bold">Rp{{ $order->total_price }}
                        </span>
                    </div>
                </div>
                <hr>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-7">
                <div class="card card__shadow mb-5">
                    <div class="card-body">
                        <h5 class="card-title">Product Details</h5>
                        <hr>
                        @php
                        $totalPriceProd = 0;
                        @endphp
                        @foreach($order->orderItems as $prod)
                        <div class="d-flex align-items-center">
                            @if($prod->item->image)
                            <img src="{{ asset('storage/' . $prod->item->image) }}" class="img-fluid rounded-3" style="width: 120px;" alt="{{ $prod->item->name }}">
                            @else
                            <img src="https://source.unsplash.com/500x500?{{ $prod->item->name }}" class="img-fluid rounded-3" style="width: 120px;" alt="{{ $prod->item->name }}">
                            @endif
                            <div class="flex-column ms-4">
                                <p class="mb-2 fw-bold">{{ $prod->item->name }}</p>
                                <p class="mb-0 text-muted fs-6">{{ $prod->qty }} Item(s) x Rp{{ $prod->item->selling_price }}</p>
                            </div>
                            <div class="flex-row ms-auto border-start ps-4 py-4">
                                <div class="fw-normal">Total : Rp{{ $prod->qty * $prod->item->selling_price }}</div>
                            </div>
                        </div>
                        @php
                        $totalPriceProd += $prod->qty * $prod->item->selling_price
                        @endphp
                        <hr>
                        @endforeach
                        <div class="d-flex justify-content-between px-3 py-3">
                            <span class="fw-bolder">Total : </span>
                            <span class="fw-bold">Rp{{ $totalPriceProd }}</span>
                        </div>
                    </div>
                </div>

                {{-- </div> --}}
                @if($order->status == 'Pending')
                <button class="btn btn-success" onclick="snap.pay('{{ $order->snap_token }}')">Complete Payment</button>
                @endif
            </div>
        </div>


        {{-- @else
                    <p class="text-center align-middle fs-4 min-vh-50">No Products Found</p>
                    @endif --}}
    </div>
</div>
{{-- </div> --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- @else
<div class="text-center fs-4 py-5 my-5">
    <p>Your cart is empty</p>
    <a href="/" class="btn btn-primary">Shop Now!</a>
</div>
@endif --}}

@endsection


{{-- <table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col" class="h5 fw-normal">Name</th>
            <th scope="col" class="h5 fw-normal text-center">Quantity</th>
            <th scope="col" class="h5 fw-normal text-center">Price</th>
            <th scope="col" class="h5 fw-normal text-center">Image</th>
        </tr>
    </thead>
    <tbody>
        orderItems belongsTo Product ('product_id')
        @foreach ($order->orderItems as $prod)
        <tr class="product-data">
            <td class="ps-3">
                {{ $prod->item->name }}
</td>
<td class="align-middle text-center">
    {{ $prod->qty }}
</td>
<td class="align-middle text-center">
    {{ $prod->price }}
</td>
<td class="align-middle text-center">
    @if($prod->item->image)
    <img src="{{ asset('storage/'.$prod->item->image) }}" alt="{{ $prod->item->name }}">
    @else
    <img src="https://source.unsplash.com/500x500?{{ $prod->item->name }}" class="img-fluid rounded-3" style="width: 120px;" alt="{{ $prod->item->name }}">
    @endif
</td>
</tr>

@endforeach

</tbody>
</table> --}}
