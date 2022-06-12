@extends('admin.layouts.main')

@section('container')

<div class="container py-4 min-vh-80">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between card-header pb-0 pb-2">
                    @if($user->is_admin == 1)
                    <h1 class="fs-4 fw-bold">User Details | <span class="badge bg-info badge-pill">Admin</span></h1>
                    @else
                    <h1 class="fs-4 fw-bold">User Details</h1>
                    @endif

                    <a href="/dashboard/users/" class="btn btn-outline-primary me-2"><i class="bi bi-chevron-left"></i> Back</a> </div>

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-8 col-md-6 ms-4 fw-bold text-light" role="alert"><i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- <script>
                    swal("Category has been updated!", "You clicked the button!", "success");

                </script> --}}
                @endif

                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <form action="" class="pb-3">
                        <div class="col-10 ms-4 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-10 ms-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-10 ms-4 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" readonly>
                        </div>
                        <div class="col-10 ms-4 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" readonly>
                        </div>
                        <div class="col-6 col-sm-5 ms-4 d-inline-block">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ $user->city }}" readonly>
                        </div>
                        <div class="col-3 col-sm-2 ms-4 d-inline-block">
                            <label for="zipcode" class="form-label">Zipcode</label>
                            <input type="number" class="form-control" name="zipcode" id="zipcode" value="{{ $user->zipcode }}" readonly>
                            {{-- <p for="" class="mb-1">Zipcode</p>
                                                @if($user->zipcode)
                                                <div class="border p-2 mb-3 rounded-2">{{ $user->zipcode }}
                        </div>
                        @else
                        <div class="border p-3 mb-3 rounded-2"></div>
                        @endif --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
