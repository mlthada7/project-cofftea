@extends('admin.layouts.main')

@section('container')

<div class="container-fluid py-4 min-vh-90">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 pb-4">
                <div class="card-header d-flex justify-content-between pb-2">
                    <h1 class="fs-4 fw-bold">Order Details</h1>
                    <a href="/dashboard/orders/" class="btn btn-outline-primary me-2"><i class="bi bi-chevron-left"></i> Back</a>
                </div>

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-8 col-md-6 ms-4 fw-bold text-light" role="alert"><i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- <script>
                    swal("Category has been updated!", "You clicked the button!", "success");

                </script> --}}
                @endif

                {{-- @if($products->count()) --}}
                <div class="card-body pt-0 pb-2 min-vh-70 d-lg-flex justify-content-lg-between">
                    <div class="col-12 col-sm-12 col-lg-4">
                        <div class="card border-1">
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-between">
                                    <p class="pe-5">Status : <span class="me-3 fw-bold">{{ $order->status }}</span></p>
                                    <p class="pe-2">Tracking Num : <span class="me-3">{{ $order->tracking_num }}</span></p>
                                    <p class="pe-4">Order Date : <span class="me-3">{{ date('d-M-Y', strtotime($order->created_at)) }}</span></p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="card border-1">
                            <div class="card-body">
                                <h5 class="card-title">Shipping Details</h5>
                                <hr>
                                <div class="d-flex flex-column justify-content-between">
                                    <p class="text-start">Name : <span class="fw-bold">{{ $order->name }}</span></p>
                                    <p class="text-start">Phone : <span class="">{{ $order->phone }}</span></p>
                                    <div class="d-flex flex-row justify-content-start">
                                        <p class="pe-2">Address <span class="">:</span></p>
                                        <p class="text-start pe-5">
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

                    <div class="col-12 col-lg-7">
                        <form action="{{ route('update-order', $order->id) }}" method="post" class="mb-3">
                            @csrf
                            @method('put')
                            <h6 class="fs-6">Order Status</h6>
                            {{-- <div class="input-group mb-3 w-50"> --}}
                            <div class="d-flex">
                                <select class="form-select h-25 w-25 me-3 align-middle" name="orderStatus">
                                    <option {{ $order->status == 'Pending' ? 'selected' : '' }} value="Pending">Pending</option>
                                    <option {{ $order->status == 'On Process' ? 'selected' : '' }} value="On Process">On Process</option>
                                    <option {{ $order->status == 'On Delivery' ? 'selected' : '' }} value="On Delivery">On Delivery</option>
                                    <option {{ $order->status == 'Completed' ? 'selected' : '' }} value="Completed">Completed</option>
                                </select>

                                @if($order->status == 'Completed')
                                <button type="submit" class="btn btn-primary" disabled>Update</button>
                                @else
                                <button type="submit" class="btn btn-primary">Update</button>
                                @endif
                            </div>

                            {{-- </div> --}}

                        </form>
                        <div class="card border-1 mb-5">
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
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bolder">Total : </span>
                                    <span class="fw-bold">Rp{{ $totalPriceProd }}</span>
                                    {{-- <h6 class="ps-auto">Total : </h6>
                                    <div class="fw-bold pe-auto">Rp{{ $order->total_price }}</div> --}}
                            </div>
                        </div>
                    </div>

                    {{-- <form action="{{ route('update-order', $order->id) }}" method="post" class="w-25 mt-4">
                    @csrf
                    @method('put')
                    <h6 class="fs-6">Order Status</h6>
                    <select class="form-select" name="orderStatus">
                        <option {{ $order->status == 'Pending' ? 'selected' : '' }} value="Pending">Pending</option>
                        <option {{ $order->status == 'On Process' ? 'selected' : '' }} value="On Process">On Process</option>
                        <option {{ $order->status == 'On Delivery' ? 'selected' : '' }} value="On Delivery">On Delivery</option>
                        <option {{ $order->status == 'Completed' ? 'selected' : '' }} value="Completed">Completed</option>
                    </select>

                    @if($order->status == 'Completed')
                    <button type="submit" class="mt-3 btn btn-primary" disabled>Update</button>
                    @else
                    <button type="submit" class="mt-3 btn btn-primary">Update</button>
                    @endif

                    </form> --}}
                    {{-- </div> --}}
                </div>
            </div>


            {{-- @else
                <p class="text-center align-middle fs-4 min-vh-50">No Products Found</p>
                @endif --}}
        </div>
    </div>
</div>
</div>

@endsection
