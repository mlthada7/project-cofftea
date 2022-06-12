{{-- @dd($categories); --}}
@extends('layouts.main')

@section('container')

<!-- Jumbotron -->

<section id="jumbotron" class="text-center mb-4">
    <header class="pt-5" id="home" style="background-image: url('{{ asset('img/heder.jpg') }}'); height: 60vh;">
        <div class="container-md">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4 text-white">Welcome to our store! <br>Choose your bean here</h1>
                    <p class="lead mb-3 text-white">The best bean in the archipelago!</p>
                </div>
            </div>
        </div>
    </header>
</section>

<div class="container-md min-vh-100">
    <section id="products">
        <div class="row justify-content-center mb-3">
            <div class="col-8 col-lg-6">
                {{-- Search bar --}}
                <form action="/products">
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if($products->count())
        <div class="container-sm mb-4">
            <div class="row text-center mb-3">
                <h2>Our Products</h2>
            </div>

            <div class=" row text-start mb-3 row-cols-auto">
                <div class="col">
                    <h3 class="fs-4">Coffee Beans</h3>
                </div>
                <div class="col mt-1">
                    <a href="/products?category=coffee-beans" class="text-decoration-none">See all</a>
                </div>
            </div>

            @if($productsC->count())
            <div class="row justify-content-center mb-5 border-bottom">
                @foreach($productsC as $product)
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="card">
                        <a href="/products/{{ $product->slug }}" class="text-decoration-none text-dark">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->category->name }}">
                            @else
                            <img src="https://source.unsplash.com/500x500?{{ $product->category->name }}" class="card-img-top" alt="{{ $product->category->name }}">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->title }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center fs-4 py-5 my-5">No Product Found</div>
            @endif

            <div class=" row text-start mb-3 row-cols-auto">
                <div class="col">
                    <h3 class="fs-4">Tea</h3>
                </div>
                <div class="col mt-1">
                    <a href="/products?category=tea" class="text-decoration-none">See all</a>
                </div>
            </div>

            @if($productsT->count())
            <div class="row justify-content-center mb-5 border-bottom">
                @foreach($productsT as $product)
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="card">
                        <a href="/products/{{ $product->slug }}" class="text-decoration-none text-dark">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->category->name }}">
                            @else
                            <img src="https://source.unsplash.com/500x500?{{ $product->category->name }}" class="card-img-top" alt="{{ $product->category->name }}">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->title }}</h5>
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

        @else
        <div class="text-center fs-4 mt-5">No Product Found</div>
        @endif

    </section>
</div>

@endsection



{{-- <div class="col-md-3 mb-3">
                <div class="card h-100 w-75">
                    <img src="https://source.unsplash.com/500x500?coffee" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Card title</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100 w-75">
                    <img src="https://source.unsplash.com/500x500?coffee" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Card title</h5>
                    </div>
                </div>
            </div> --}}
