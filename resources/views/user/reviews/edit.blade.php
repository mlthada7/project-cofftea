@extends('user.layouts.main')

@section('container')

<div class="container-sm mb-3 min-vh-100">
    <div class="row">
        <div class="col-12 mt-5 pt-5">
            <div class="card">
                <div class="card-body">
                    <h5>Edit review for {{ $review->product->name }}</h5>
                    <a href="/product/{{ $review->product->slug }}">Back</a>
                    <form action="/update-review" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="reviewId" value="{{ $review->id }}">
                        <textarea name="userReview" id="userReview" class="form-control" rows="3" placeholder="The product is awesome">{{ old('userReview', $review->user_review) }}</textarea>
                        <button type="submit" class="btn btn-primary mt-3">Update Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
