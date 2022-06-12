@extends('admin.layouts.main')

@section('container')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between pb-0 mb-3">
                    <h1 class="fs-4 fw-bold">Edit Category</h1>
                    <a href="/dashboard/categories" class="btn btn-outline-primary me-2"><i class="bi bi-chevron-left"></i> Back</a>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="col-lg-8 ms-4">
                        <form action="/dashboard/categories/{{ $category->id }}" method="POST" class="mb-5" enctype="multipart/form-data" autocomplete="off">
                            @method('put')
                            @csrf
                            <div class="mb-3 pe-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                is-invalid
                            @enderror" id="name" autofocus value="{{ old('name', $category->name) }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 pe-4">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control @error('slug')
                                is-invalid
                            @enderror" id="slug" value="{{ old('slug', $category->slug) }}">
                                @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 pe-4">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="description" type="hidden" name="description" value="{{ old('description', $category->description) }}">
                                <trix-editor input="description"></trix-editor>
                            </div>

                            <div class="mb-3 pe-4">
                                <label for="image" class="form-label">Category Image</label>
                                @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif

                                <input class="form-control @error('image') @enderror" type="file" name="image" id="image" onchange="previewImage()">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Category</button>
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

    {{-- <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <input id="body" name="body" type="hidden" name="body" value="{{ old('body') }}">
    <trix-editor input="body"></trix-editor>
</div>

<div class="mb-3">
    <label for="id" class="form-label">Category</label>
    <select class="form-select" name="id">
        @foreach ($categories as $category)
        <option value="1">Coffee</option>
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-check">
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
