@extends('user.layouts.main')

@section('container')

<div class="container-sm mb-4 mt-2 pt-5">
    <div class="row mb-3">
        <h2>{{ $header }}</h2>
    </div>

    <div class="row justify-content-between mb-3">
        <div class="col-md-6">
            <form action="/products">
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>

    @if($products->count())
    <div class="row justify-content-center justify-content-sm-start">
        @foreach($products as $product)
        <div class="col-10 col-md-4 col-sm-6 col-lg-3 mb-3">
            <div class="card card-product p-1 shadow-sm my-2 mx-auto" style="width: 13rem">
                <a href="/product/{{ $product->slug }}" class="text-decoration-none text-dark">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img img-fluid" alt="{{ $product->name }}">
                    @else
                    <img src="https://source.unsplash.com/500x500?{{ $product->name }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-normal">{{ $product->name }}</h5>
                        <span class="float-md-start fw-bold pb-3">Rp{{ $product->selling_price }}</span>
                        @if($product->original_price)
                        <span class="float-md-end float-end text-decoration-line-through pb-3 text-muted">Rp{{ $product->original_price }}</span>
                        @endif

                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="text-center fs-4 py-5 my-5">No Product Found</div>
    @endif
</div>

<div class="d-flex justify-content-center mb-5">
    {{ $products->links() }}
</div>

@endsection
{{-- <div class="container-md min-vh-100">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4 mb-3">
            <a href="/products?category={{ $category->slug }}">
<div class="card bg-dark text-white">
    <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
    <div class="card-img-overlay d-flex align-items-center p-0">
        <h5 class="card-title text-center flex-fill p-4 fs-3 overflow-auto" style="background-color: rgba(0, 0, 0, 0.6)">{{ $category->name }}</h5>
    </div>
</div>
</a>
</div>
@endforeach
</div>
</div> --}}
