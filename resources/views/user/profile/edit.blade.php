@extends('user.layouts.main')

@section('container')

<div class="container py-5 min-vh-80">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between card-header mb-4">
                    <h1 class="fs-3">Edit User Details</h1>
                    {{-- <a href="/dashboard/products/create" class="btn btn-primary mb-4"><i class="bi bi-plus-square me-1"></i> Add New Product</a> --}}
                    <a href="/profile" class="btn btn-outline-secondary mb-4"><i class="fas fa-angle-left me-1"></i>
                        {{-- <i class="bi bi-plus-square me-1"></i> --}}
                        Back</a>
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

                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <form action="/profile/{{ $user->id }}" method="post" autocomplete="off">
                        @method('put')
                        @csrf
                        <div class=" col-10 col-sm-8 ms-4 mb-3">
                            <label for="name" class="form-label">Name </label>
                            <input type="text" class="form-control @error('name')
                                is-invalid
                            @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-10 col-sm-8 ms-4 mb-4">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" name="email" id="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-10 col-sm-8 ms-4 mb-4">
                            <label for="phone" class="form-label">Phone </label>
                            <input type="tel" class="form-control @error('phone')
                                is-invalid
                            @enderror" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-10 col-sm-8 ms-4 mb-4">
                            <label for="address" class="form-label">Address </label>
                            <input type="text" class="form-control @error('address')
                                is-invalid
                            @enderror" name="address" id="address" value="{{ old('address', $user->address) }}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-6 col-sm-5 ms-4 d-inline-block">
                            <label for="city" class="form-label">City </label>
                            <input type="text" class="form-control @error('city')
                                is-invalid
                            @enderror" name="city" id="city" value="{{ old('city', $user->city) }}">
                            @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-3 col-sm-2 ms-4 d-inline-block">
                            <label for="zipcode" class="form-label">Zipcode </label>
                            <input type="number" class="form-control @error('zipcode')
                                is-invalid
                            @enderror" name="zipcode" id="zipcode" value="{{ old('zipcode', $user->zipcode) }}">
                            @error('zipcode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary d-block w-25 w-sm-50 ms-4 my-3">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
