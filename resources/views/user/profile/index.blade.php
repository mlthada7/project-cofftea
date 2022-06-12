@extends('user.layouts.sidebar')

@section('content')

{{-- @dd($user->city); --}}

@if (count($errors) > 0)
<script type="text/javascript">
    $(document).ready(function() {
        $('#editProfileModal').modal('show');
    });

</script>
@endif
<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModal"><i class="fas fa-user-edit"></i> Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/profile/{{ $user->id }}" method="post" autocomplete="off">
                    @method('put')
                    @csrf
                    <div class=" col-10 ms-4 mb-3">
                        <label for="name" class="form-label">Name </label>
                        <input type="text" class="form-control @error('name')
                            is-invalid
                        @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-10 ms-4 mb-4">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control @error('email')
                            is-invalid
                        @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-10 ms-4 mb-4">
                        <label for="phone" class="form-label">Phone <span class="text-muted">(Optional)</span></label>
                        <input type="number" class="form-control @error('phone')
                            is-invalid
                        @enderror" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="0812xxxxxxxx">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-10 ms-4 mb-4">
                        <label for="address" class="form-label">Address <span class="text-muted">(Optional)</span></label>
                        <textarea type="text" class="form-control @error('address')
                            is-invalid
                        @enderror" name="address" id="address" placeholder="Jl. Sesame Street">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-10 ms-4 mb-4">
                        <label for="city" class="form-label">City <span class="text-muted">(Optional)</span></label>
                        <select class="form-select" name="city" id="city">
                            <option value=" {{ old('city', $user->city) == '' ? 'selected' : ''}}"></option>
                            <option value="Jakarta Utara" {{ old('city', $user->city) == "Jakarta Utara" ? 'selected' : ''}}>Jakarta Utara</option>
                            <option value="Jakarta Pusat" {{ old('city', $user->city) == "Jakarta Pusat" ? 'selected' : ''}}>Jakarta Pusat</option>
                            <option value="Jakarta Barat" {{ old('city', $user->city) == "Jakarta Barat" ? 'selected' : ''}}>Jakarta Barat</option>
                            <option value="Jakarta Timur" {{ old('city', $user->city) == "Jakarta Timur" ? 'selected' : ''}}>Jakarta Timur</option>
                            <option value="Jakarta Selatan" {{ old('city', $user->city) == "Jakarta Selatan" ? 'selected' : ''}}>Jakarta Selatan</option>
                        </select>
                        {{-- <input type="text" class="form-control @error('city')
                            is-invalid
                        @enderror" name="city" id="city" value="{{ old('city', $user->city) }}">
                        @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror --}}
                    </div>
                    <div class="col-3 col-sm-4 ms-4 d-inline-block">
                        <label for="zipcode" class="form-label">Zipcode <span class="text-muted">(Optional)</span></label>
                        <input type="number" class="form-control @error('zipcode')
                            is-invalid
                        @enderror" name="zipcode" id="zipcode" value="{{ old('zipcode', $user->zipcode) }}" placeholder="12930">
                        @error('zipcode')
                        {{-- <p class="text-danger">{{ $message }}</p> --}}
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container py-5 min-vh-80"> --}}
<div class="col-10 col-sm-9 col-md-8 col-lg-7">
    <div class="card my-4 shadow-sm">
        <div class="d-flex justify-content-between card-header align-items-center">
            <h1 class="fs-4"><i class="fas fa-user"></i> Profile |
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    Edit Data
                </button></h1>
            {{-- <a href="/" class="btn btn-outline-secondary mb-4"><i class="fas fa-angle-left me-1"></i> --}}
        </div>

        <div class="card-body px-3 py-4 min-vh-70">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-11 ms-4" role="alert"><i class="bi bi-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="" class="pb-3">
                <div class="col-11 ms-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
                </div>
                <div class="col-11 ms-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                </div>
                <div class="col-11 ms-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" readonly>
                </div>
                <div class="col-11 ms-4 mb-3">
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

        {{-- <a href="/profile/{{ $user->id }}/edit" class="btn btn-primary d-block w-50 w-sm-50 ms-4 my-3">Edit Data</a> --}}
    </div>
</div>
{{-- </div> --}}



@endsection
