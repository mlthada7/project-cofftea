@extends('admin.layouts.main')

@section('container')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between pb-0 mb-0">
                    <h1 class="fs-4 fw-bold">Add New Product</h1>
                    <a href="/dashboard/products/" class="btn btn-outline-secondary me-2 float-end"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="col-lg-9 ms-4 me-4">
                        <form action="/dashboard/products" method="POST" class="mb-5" enctype="multipart/form-data" autocomplete="off">
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
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                            <div class="mb-3 col-3 d-inline-block me-4">
                                <label for="original_price" class="form-label">Original Price <span class="text-muted text-muted">(Optional)</span></label>
                                <input type="number" name="original_price" class="form-control @error('original_price')
                                is-invalid
                            @enderror" id="original_price" value="{{ old('original_price') }}">
                                @error('original_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-3 d-inline-block me-4">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number" name="selling_price" class="form-control @error('selling_price')
                                is-invalid
                            @enderror" id="selling_price" value="{{ old('selling_price') }}">
                                @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-2 d-inline-block">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" name="qty" class="form-control @error('qty')
                                is-invalid
                            @enderror" id="qty" value="{{ old('qty') }}">
                                @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('image') @enderror" type="file" name="image" id="image" onchange="previewImage()">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Product</button>
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

        // trix-editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

    </script>

    @endsection

    {{-- <div class="mb-3">
                                <label for="id" class="form-label">Category</label>
                                <select class="form-select" name="id">
                                    @foreach ($categories as $category)
                                    <option value="1">Coffee</option>
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
    </select>
</div> --}}
