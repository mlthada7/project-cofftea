{{-- @dd($categories); --}}
@extends('user.layouts.main')

@section('container')

<!-- Jumbotron -->
{{-- @dd($trProducts); --}}

@if(session()->has('statusPlaceOrder'))
<script>
    swal("{{ session('statusPlaceOrder') }}");

</script>
@endif

@if(session()->has('status'))
<script>
    swal("{{ session('status') }}");

</script>
@endif

<div class="container-md min-vh-100 mb-5 mt-5">
    <div id="carouselExampleCaptions" class="carousel slide mb-4 pt-0 mt-4 d-block" data-bs-ride="carousel">
        {{-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> --}}
        <div class="carousel-inner">
            <div class="carousel-item active rounded-3">
                <img src="/img/cafe2.jpg" class="rounded-3" alt="Coffee Beans" style="width: 100%; max-height: 25rem; object-fit: cover; filter: brightness(55%)">
                <div class="carousel-caption d-md-block">
                    <h1 class="featurred-heading">Welcome To Cofftea!</h1>
                    <p class="fw-light">A Place for you to find coffee beans & tea leaf.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/coffee.jpg" class="rounded-3" alt="Coffee Beans" style="width: 100%; max-height: 25rem; object-fit: cover; filter: brightness(55%)">
                <div class="carousel-caption d-md-block">
                    <h1 class="featurred-heading">We Offer High Quality Product</h1>
                    <p class="fw-light">Take a Look at Our Product Category.</p>
                    <a href="/categories" class="btn btn-outline-primary">See More</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/tea4.jpg" class="rounded-3" alt="Coffee Beans" style="width: 100%; max-height: 25rem; object-fit: cover; filter: brightness(40%)">
                <div class="carousel-caption d-md-block">
                    <h1 class="featurred-heading">Find Coffee Beans & Tea</h1>
                    <p class="fw-light">Happy shopping!</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section id="products">
        <div class="row justify-content-center mb-3">
            <div class="col-8 col-lg-6">
                {{-- Search bar --}}
                <form action="/products">
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search Product.." name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-sm mb-4">
            <div class="row mb-3">
                <h2 class="fs-3">Featured Products</h2>
            </div>

            @if($products->count())
            <div class="col border-bottom pb-4">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($products as $product)
                    {{-- <div class="item"> --}}
                    <div class="card card-product p-1 shadow-sm me-3 my-2">
                        <a href="/product/{{ $product->slug }}" class="text-decoration-none text-dark">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img img-fluid" alt="{{ $product->name }}">
                            @else
                            <img src="https://source.unsplash.com/500x500?{{ $product->name }}" class="card-img img-fluid" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-normal">{{ $product->name }}</h5>
                                <span class="float-md-start fw-bold pb-3 fw-6">Rp{{ $product->selling_price }}</span>
                                @if($product->original_price)
                                <span class="float-md-end float-end text-decoration-line-through pb-3 text-muted">Rp{{ $product->original_price }}</span>
                                @endif
                            </div>
                        </a>
                    </div>
                    {{-- </div> --}}
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center fs-4 py-5 my-5">No Product Found</div>
            @endif
        </div>

        <div class="container-sm mb-5">
            <div class="row mb-3">
                <h2 class="fs-3">Trending Products</h2>
            </div>

            @if($trProducts->count())
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach($trProducts->random(3) as $product)
                    <div class="item">
                        <div class="card card-product p-1 shadow-sm me-3 my-2">
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
            </div>
            @else
            <div class="text-center fs-4 py-5 my-5">No Product Found</div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('scriptOwl')
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });

    $('.featured-carousel').owlCarousel({
        loop: true
        , margin: 10
        , nav: false
        , responsive: {
            0: {
                items: 1
            }
            , 400: {
                items: 2
            }
            , 768: {
                items: 3
            }
            , 992: {
                items: 4
            }
            , 1200: {
                items: 5
            }
        }
    })

</script>
@endsection
