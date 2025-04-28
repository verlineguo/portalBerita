@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    
                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>                                
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h5 class="mb-4">Edit User</h5>
                    
                    <form class="row g-3" action="{{ isset($user) ? route('admin.user.update', $user->id) : '#' }}" method="POST">
                        @csrf 
                        @method('PUT')

                        <!-- Name -->
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{ old('name', $user->name ?? '') }}" 
                                placeholder="Enter user name" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="{{ old('email', $user->email ?? '') }}" 
                                placeholder="Enter user email" required>
                        </div>

                        <!-- Role Selection -->
                        <div class="col-md-12">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="0" {{ (isset($user) && $user->role == 0) ? 'selected' : '' }}>Admin</option>
                                <option value="1" {{ (isset($user) && $user->role == 1) ? 'selected' : '' }}>Writer</option>
                                <option value="2" {{ (isset($user) && $user->role == 2) ? 'selected' : '' }}>Visitor</option>
                            </select>
                        </div>
                        

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection
