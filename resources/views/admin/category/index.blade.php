@extends('admin.layouts.main')

@section('container')
<div class="container-fluid py-4 min-vh-80">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between card-header pb-0">
                    <h1 class="fs-4 fw-bold">Product Category</h1>
                    <a href="/dashboard/categories/create" class="btn btn-primary mb-4"><i class="bi bi-plus-square me-1"></i> Add New Category</a>
                </div>

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-8 col-md-6 ms-4 fw-bold text-light" role="alert"><i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- <script>
                    swal("Category has been updated!", "You clicked the button!", "success");

                </script> --}}
                @endif

                @if($categories->count())
                <div class="card-body px-0 pt-0 pb-2 min-vh-70">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-9">#</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Name</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Description</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Image</th>
                                    <th class="text-center pe-2 text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle ps-4">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $category->name }}</td>
                                    <td class="align-middle">{!! $category->meta_description !!}</td>

                                    <td class="align-middle">
                                        @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="max-height: 7rem">
                                        @else
                                        <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="img-fluid" alt="{{ $category->name }}" style="max-height: 7rem">
                                        @endif
                                    </td>

                                    <td class="align-middle text-center">
                                        {{-- <a href="" class="badge bg-info font-weight-bold text-xs me-1" data-toggle="tooltip" data-original-title="Edit user"><i class="bi bi-eye"></i>
                                        </a> --}}

                                        <a href="/dashboard/categories/{{ $category->id }}/edit" class="badge bg-warning font-weight-bold text-xs me-1" data-toggle="tooltip" data-original-title="Edit user"><i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="/dashboard/categories/{{ $category->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge bg-danger font-weight-bold text-xs border-0 me-1" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <p class="text-center align-middle fs-4 min-vh-50">No Category Found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

{{-- <tr>
    <td>
        <div class="d-flex px-2 py-1">
            <div>
                <img src="/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">Alexa Liras</h6>
                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
            </div>
        </div>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0">Programator</p>
        <p class="text-xs text-secondary mb-0">Developer</p>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
    </td>
    <td class="align-middle text-center">
        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
    </td>
    <td class="align-middle">
        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
            Edit
        </a>
    </td>
</tr> --}}
