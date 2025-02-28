@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forms</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>                                
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="mb-4">Edit Category</h5>
                    
                    <form class="row g-3" action="{{ isset($categories) ? route('admin.category.update', $categories->id) : '#' }}" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{ old('name', $categories->name ?? '') }}" 
                                placeholder="Enter category name" required>
                        </div>
                        <div class="col-md-12">
							<label for="status" class="form-label">Status</label>
							<select class="form-control" id="status" name="status">
								<option value="1" {{ $categories->status == 1 ? 'selected' : '' }}>Active</option>
								<option value="0" {{ $categories->status == 0 ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>


                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
@endsection
