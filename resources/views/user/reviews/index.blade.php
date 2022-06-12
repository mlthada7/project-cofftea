@extends('user.layouts.main')

@section('container')

<div class="container-sm mb-3 min-vh-100">
    <div class="row">
        <div class="col-12 mt-5 pt-5">
            <div class="card">
                <div class="card-body">
                    @if($verifiedPurchase->count() > 0)
                    <h5>You are writing review for {{ $product->name }}</h5>
                    <form action="/add-review" method="post">
                        @csrf
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        <textarea name="userReview" id="userReview" class="form-control" rows="3" placeholder="The product is awesome"></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                    </form>
                    @else
                    <div class="alert alert-danger">
                        <h5>You are not eligible to review this product</h5>
                        <p>Only customer who purchased the product able to write a review</p>
                        <a href="/product/{{ $product->slug }}" class="btn btn-primary">Back to product</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
