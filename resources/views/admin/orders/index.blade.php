@extends('admin.layouts.main')

@section('container')
<div class="container-fluid py-4 min-vh-80">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between card-header pb-0">
                    <h1 class="fs-4 fw-bold">Order List</h1>
                    <div class="search-order">
                        <form action="/search-order" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control mb-3" placeholder="#ID..." name="searchID" id="search_id" autofocus required>
                                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
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

                @if($orders->count())
                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-9">#</th>
                                    <th class="text-center pe-2 fw-bolder ps-2">Order Date</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Tracking ID</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Status</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ date('d-M-Y', strtotime($order->created_at)) }}</td>
                                    <td class="align-middle text-center">{{ $order->tracking_num }}</td>
                                    {{-- <td class="align-middle text-center">{{ $order->status == '0' ? 'Pending' : 'Completed' }}</td> --}}
                                    <td class="align-middle text-center">{{ $order->status }}</td>

                                    {{-- <td class="align-middle text-center">
                                        @if($order->image)
                                        <img src="{{ asset('storage/' . $order->image) }}" alt="{{ $order->name }}" class="img-fluid" style="max-height: 7rem;">
                                    @else
                                    <img src="https://source.unsplash.com/500x500?{{ $order->name }}" class="img-fluid" alt="{{ $order->name }}" style="max-height: 7rem;">
                                    @endif
                                    </td> --}}

                                    <td class="align-middle text-center">
                                        <a href="/dashboard/orders/{{ $order->id }}" class="badge bg-info font-weight-bold text-xs me-1" data-toggle="tooltip" data-original-title="Edit user">
                                            {{-- <i class="bi bi-eye"></i> --}}
                                            View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-9">#</th>
                                    <th class="text-center pe-2 fw-bolder ps-2">Order Date</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Tracking ID</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Status</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <p class="text-center align-middle fs-4 mt-5 min-vh-50">No Orders Found</p>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
