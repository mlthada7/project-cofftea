@extends('user.layouts.sidebar')

@section('content')


{{-- <div class="container py-5 min-vh-80"> --}}
@if($orders->count())
{{-- <section class="py-4 min-vh-100"> --}}
@if(session()->has('status'))
<script>
    swal("{{ session('status') }}");

</script>
@endif

{{-- Product Data --}}
{{-- <div class="row"> --}}
<div class="col-9">
    <h2 class="py-3">Order List</h2>
    <table class="table table-responsive border border-1 table-striped shadow-sm">
        <thead>
            <tr>
                <th scope="col" class="h5 fw-normal text-center">Order Date</th>
                {{-- <th scope="col" class="h5 fw-normal">Product</th> --}}
                <th scope="col" class="h5 fw-normal text-center"> Tracking ID</th>
                <th scope="col" class="h5 fw-normal text-center">Total Price</th>
                <th scope="col" class="h5 fw-normal text-center">Status</th>
                <th scope="col" class="h5 fw-normal text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php $total = 0; @endphp --}}
            @foreach ($orders as $order)
            {{-- @dd($item->products->name); --}}
            <tr class="product-data">
                <td class="ps-3">
                    <p>{{ date('d F Y - H:i', strtotime($order->created_at)) }}</p>
                </td>
                <td class="ps-3 align-middle text-center">
                    <p>{{ $order->tracking_num }}</p>
                </td>
                <td class="align-middle text-center">
                    <p>Rp{{ number_format($order->total_price, 0, '', '.') }}</p>
                </td>
                <td class="align-middle text-center">
                    {{-- <p class="mb-0" style="font-weight: 500;">{{ $order->status == '0' ? 'Pending' : 'Completed' }}</p> --}}
                    <p class="" style="font-weight: 500;">{{ $order->status }}</p>
                </td>
                <td class="align-middle text-center">
                    @if($order->status == 'Pending')
                    <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $order->snap_token }}')">Complete Payment</button>
                    @endif
                    <a href="/orders/{{ $order->id }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Details
                    </a>
                </td>
            </tr>

            @endforeach

        </tbody>
        <tfoot>
            {{ $orders->links() }}
        </tfoot>
    </table>
</div>

@else
<div class="col-9 text-center fs-4 py-5 my-5">
    <p>No Transaction Found</p>
    <a href="/" class="btn btn-primary">Shop Now!</a>
</div>
@endif


<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

@endsection
