@extends('admin.layouts.app')
@section('content')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Forms</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
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
								<h5 class="mb-4">Add Post</h5>
								<form class="row g-3" action="{{ route('admin.post.store') }}" method="POST">
									@csrf 
									<div class="col-md-12">
										<label for="meta-title" class="form-label">meta title</label>
										<input type="text" class="form-control" id="meta-title" name="meta-title" value="{{ old('meta-title') }}" placeholder="Enter your meta title">
									</div>
									<div class="col-md-12">
										<label for="meta-keyword" class="form-label">meta keyword</label>
										<input type="text" class="form-control" id="meta-keyword" name="meta-keyword" value="{{ old('meta-keyword') }}" placeholder="Enter your meta keyword">
									</div>
									<div class="col-md-12">
										<label for="meta-description" class="form-label">meta description</label>
										<input type="text" class="form-control" id="meta-description" name="meta-description" value="{{ old('meta-description') }}" placeholder="Enter your meta description">
									</div>
									<div class="col-md-12">
										<label for="title" class="form-label">title</label>
										<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter your title">
									</div>
									<div class="col-md-12">
										<label for="slug" class="form-label">slug</label>
										<input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Enter your slug">
									</div>
									<div class="col-md-12">
										<label for="image" class="form-label">image</label>
										<input type="image" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="place your image">
									</div>

									<div class="col-md-12">
										<label for="description" class="form-label">description</label>
										<input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Enter your description">
									</div>
									<select name="category_id" class="form-control" required>
										<option value="">Select Category</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>

									<div class="col-md-12">
										<label for="writer" class="form-label">writer</label>
										<input type="" class="form-control" id="writer" name="writer_id" value="{{ old('writer_id') }}" placeholder="enter writer">
									</div>

									<div class="col-md-12">
										<label for="status" class="form-label">Status</label>
										<select class="form-control" id="status" name="status">
											<option value="1" selected>Active</option>
											<option value="0">Inactive</option>
										</select>
									</div>


									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Submit</button>
											<button type="reset" class="btn btn-light px-4">Reset</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						

				

			</div>		
@endsection

