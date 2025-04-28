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
                    <li class="breadcrumb-item active" aria-current="page">Add User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="row">
        <div class="col-xl-10 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    
                

                    <h5 class="mb-4">Add New User</h5>
                    <form class="row g-3" action="{{ route('admin.user.store') }}" method="POST">
                        @csrf 

                        <!-- Name -->
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name') }}" placeholder="Enter user name">
                        </div>

                        <!-- Email -->
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email') }}" placeholder="Enter user email">
                        </div>

                        <!-- Password -->
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter password">
                        </div>

                        <!-- Role Selection -->
                        <div class="col-md-12">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="0" {{ old('role') == "0" ? 'selected' : '' }}>Admin</option>
                                <option value="1" {{ old('role') == "1" ? 'selected' : '' }}>Writer</option>
                                <option value="2" {{ old('role') == "2" ? 'selected' : '' }}>Visitor</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>Inactive</option>
                            </select>
                        

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    // Display SweetAlert for errors or success messages when page loads
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                html: `@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
        
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    });



    // Submit button with SweetAlert confirmation
    document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Confirm Submission',
            text: 'Are you sure you want to add this tag?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('tagForm').submit();
            }
        });
    });

    document.getElementById('resetBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Reset Form',
            text: 'Are you sure you want to reset all fields?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reset it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('tagForm').reset();
                document.getElementById('image-preview').classList.add('d-none');
                document.getElementById('image-preview').src = '';
                
                Swal.fire(
                    'Reset!',
                    'The form has been reset.',
                    'success'
                );
            }
        });
    });
</script>
@endsection