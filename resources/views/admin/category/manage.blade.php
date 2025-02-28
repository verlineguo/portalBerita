@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">DataTable Example</h6>
    <hr/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All category</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success my-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
							<th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
							<td>
							@if ($category->status == 1)
								<span class="badge bg-success">Active</span>
							@else
								<span class="badge bg-danger">Inactive</span>
							@endif	
							</td>
                            <td>
                                <a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-info text-white">Edit</a>
                                <form action="{{ route('admin.category.delete', $category->id) }}" method="post" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>  
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
