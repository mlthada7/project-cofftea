@extends('user.layouts.main')

@section('container')

<div class="container mb-4 mt-5 pt-5">
    <div class="row mb-3">
        <h3>Product Categories</h3>
    </div>

    @if($categories->count())
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-3 col-sm-4 col-6 mb-3">
            <div class="card card-categories shadow-sm">
                <a href="/products?category={{ $category->slug }}" class="text-decoration-none text-dark">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                    @else
                    <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img-top" alt="{{ $category->name }}">
                    @endif
                    <div class="card-body pb-3">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        {!! $category->description !!}
                        {{-- <span class="float-end text-decoration-line-through">{{ $category->original_price }}</span> --}}
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
