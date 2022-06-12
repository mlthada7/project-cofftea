@extends('user.layouts.main')

@section('container')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/add-rating" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if($userRating)
                            @for($i = 1; $i <= $userRating->stars_rated; $i++)
                                <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                <label for="rating{{ $i }}" class="fa fa-star"></label>
                                @endfor
                                @for($j=$userRating->stars_rated+1; $j <=5; $j++) <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                    <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor

                                    @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                    @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mt-4 py-4 mb-4 shadow-blur bg-light border-top">
    <div class="container">
        <h6 class="mb-0 text-muted"><a href="/categories" class="text-decoration-none link-secondary">Categories</a> / <a href="/products?category={{ $product->category->slug }}" class="text-decoration-none link-secondary">{{ $product->category->name }}</a> / <span class="fw-bold">{{ $product->name }}</span></h6>
    </div>
</div>

<div class="container-sm mb-3 min-vh-100">
    @if(session()->has('status'))
    <script>
        swal("{{ session('status') }}");

    </script>
    @endif
    <div class="row mb-3 pt-3 border-bottom justify-content-center product-data">
        {{-- <form action="/cart" method="post" enctype="multipart/form-data">
            @csrf --}}
        <div class="col-12 col-sm-5 col-md-4 col-lg-3 mb-4 text-center">
            {{-- <div class="d-block mx-auto min-height-100"> --}}
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-100" alt="{{ $product->name }}">
            @else
            <img src="https://source.unsplash.com/500x500?{{ $product->name }}" class="img-fluid w-100" alt="{{ $product->name }}" style="max-width: 17rem; min-width: 11rem;">
            @endif
            {{-- </div> --}}
        </div>

        <div class="col-sm-7 col-md-7 col-lg-7 mb-2">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title mb-2">{{ $product->name }}</h1>
                    <label class="fw-bold me-4 fs-5">Rp{{ $product->selling_price }}</label>
                    @if($product->original_price)
                    <label class="text-muted text-decoration-line-through">Rp{{ $product->original_price }}</label>
                    @endif
                    @php $rate = number_format($ratingValue) @endphp
                    <div class="ratings">
                        @for($i = 1; $i <= $rate; $i++) <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = $rate+1; $j <= 5; $j++) <i class="fa fa-star"></i>
                                @endfor
                                <span class="text-small">
                                    @if($ratings->count() > 0)
                                    {{-- {{ $rate }} --}}
                                    | {{ $ratings->count() }} Ratings
                                    @else
                                    | No Ratings
                                    @endif
                                </span>
                    </div>

                    <div class="mb-3 mt-3">
                        {!! $product->description!!}
                    </div>

                    {{-- <label class="badge bg-success mb-3">Trending</label> --}}
                    @if($product->qty > 0)
                    <label class="badge bg-info mb-3">Stock Available</label>
                    @else
                    <label class="badge bg-danger mb-3">Out of stock</label>
                    @endif
                    @if($product->original_price)
                    <label class="badge bg-warning mb-3">Sale</label>
                    @endif

                    {{-- <div class="row"> --}}
                    {{-- <form action="" method="post">
                    @csrf --}}
                    {{-- <input type="hidden" name="id" value="{{ $product->id }}" class="product_id"> --}}
                    {{-- <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="selling_price" value="{{ $product->selling_price }}">
                    <input type="hidden" name="image" value="{{ $product->image }}">
                    <input type="hidden" name="meta_desc" value="{!! $product->meta_description!!}"> --}}

                    <div class="col-4 col-sm-5 col-md-4 col-lg-2 mb-3">
                        <input type="hidden" name="id" value="{{ $product->id }}" class="product-id">
                        <label for="quantity">Quantity</label>
                        {{-- <input type="number" class="form-control" name="quantity" value="1"> --}}
                        <div class="input-group mb-3">
                            {{-- <button class="input-group-text decrement-btn">-</button> --}}
                            <input type="number" class="form-control qty-input" name="quantity" value="1" id="quantity">
                            {{-- <button class="input-group-text increment-btn">+</button> --}}
                        </div>
                    </div>

                    @if($product->qty > 0)
                    <button class="btn btn-primary addToCartBtn" type="submit"><i class="bi bi-cart-plus"></i> Add to cart</button>
                    @else
                    <button class="btn btn-primary addToCartBtn" type="submit" disabled><i class="bi bi-cart-plus"></i> Add to cart</button>
                    @endif

                    {{-- </form> --}}
                    {{-- </div> --}}

                </div>
            </div>
            {{-- <h1 class="mb-2">{{ $product->name }}</h1> --}}

        </div>
    </div>

    <div class="row pb-5">
        <div class="col-md-10 mb-3">
            <h3 class="mb-3">Product Review</h3>
            <!-- Button trigger modal -->
            @auth
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Rate This Product
            </button>
            <a href="/{{ $product->slug }}/userreview" class="btn btn-outline-secondary">
                Write Review
            </a>
            @endauth
        </div>
        <div class="col-12">
            @foreach ($reviews as $review)
            <label>{{ $review->user->name }}</label>
            {{-- @if($review->user_id == Auth::id())
            <a href="/edit-review/{{ $product->slug }}/userreview">Edit</a>
            @endif --}}
            <br>
            @php
            $rating = App\Models\Rating::where('product_id', $product->id)->where('user_id', $review->user->id)->first();
            @endphp
            @if($rating)
            @php
            $userRated = $rating->stars_rated
            @endphp
            @for($i = 1; $i <= $userRated; $i++) <i class="fa fa-star checked"></i>
                @endfor
                @for($j = $userRated+1; $j <= 5; $j++) <i class="fa fa-star"></i>
                    @endfor
                    @endif
                    <small> Reviewed on {{ $review->created_at->format('d M Y') }}</small>
                    <p>{{ $review->user_review }}</p>
                    @endforeach
        </div>
    </div>

</div>

@endsection
