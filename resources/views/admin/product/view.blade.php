@extends('admin.layouts.main')

@section('container')

<div class="container-fluid py-4 min-vh-80">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between card-header pb-0">
                    <h1 class="fs-4 fw-bold">Product Details</h1>
                    <a href="/dashboard/products/" class="btn btn-outline-primary me-2"><i class="bi bi-chevron-left"></i> Back</a>
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

                @if($product->count())
                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <div class="row mb-3 pt-3 justify-content-center product-data">
                        <div class="col-12 col-sm-5 col-md-4 col-lg-3 mb-4 text-center">
                            {{-- <div class="d-block mx-auto min-height-100"> --}}
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-100" alt="{{ $product->name }}">
                            @else
                            <img src="https://source.unsplash.com/500x500?{{ $product->name }}" class="img-fluid w-100" alt="{{ $product->name }}" style="max-width: 17rem; min-width: 11rem;">
                            @endif
                            {{-- </div> --}}
                        </div>

                        <div class="col-11 col-sm-6 col-md-7 col-lg-7 border rounded-2 mb-2 p-4">
                            <h1 class="mb-2 fs-4">{{ $product->name }}</h1>
                            <label class="fw-bold me-4 fs-5">Rp{{ $product->selling_price }}</label>
                            @if($product->original_price)
                            <label class="text-muted text-decoration-line-through">Rp{{ $product->original_price }}</label>
                            @endif
                            <div class="mb-3 mt-3">
                                {!! $product->description!!}
                            </div>

                            {{-- <label class="badge bg-success mb-3">Trending</label> --}}
                            @if($product->qty > 0)
                            <label class="badge bg-info mb-3">Stock Available</label>
                            @else
                            <label class="badge bg-danger mb-3">Out of stock</label>
                            @endif

                            <div class="col-4 col-sm-5 col-md-4 col-lg-2 mb-3">
                                <label for="quantity" class="fs-6">Quantity : {{ $product->qty }}</label>
                            </div>

                            <a href="/dashboard/products/{{ $product->id }}/edit" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit Product</a>

                            <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger font-weight-bold" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> Remove</button>
                            </form>

                            {{-- </form> --}}
                            {{-- </div> --}}
                        </div>
                        <hr class="w-95">


                    </div>


                </div>
                @else
                <p class="text-center align-middle fs-4 min-vh-50">No Products Found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
