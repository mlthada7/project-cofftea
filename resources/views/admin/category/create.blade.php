@extends('admin.layouts.main')

@section('container')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between pb-0 mb-0">
                    <h1 class="fs-4 fw-bold">Add New Category</h1>
                    <a href="/dashboard/categories/" class="btn btn-outline-secondary me-2 float-end"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="col-lg-8 ms-4">
                        <form action="/dashboard/categories" method="POST" class="mb-5" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                is-invalid
                            @enderror" id="name" autofocus value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control @error('slug')
                                is-invalid
                            @enderror" id="slug" value="{{ old('slug') }}">
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                            {{-- <div class="form-check">
                                <label class="form-check-label" for="status">
                                    Status
                                </label>
                                <input class="form-check-input" type="checkbox" name="status" value="" id="status">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="popular">
                                    Popular
                                </label>
                                <input class="form-check-input" type="checkbox" name="popular" value="" id="popular">
                            </div> --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">Category Image</label>
                                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('image') @enderror" type="file" name="image" id="image" onchange="previewImage()">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                @error('body')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input id="body" name="body" type="hidden" name="body" value="{{ old('body') }}">
                            <trix-editor input="body"></trix-editor>
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    // check slug
    name.addEventListener('change', function() {
        //fetch data dari mana
        fetch('/dashboard/categories/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    // Preview Image
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    }

</script>

@endsection
