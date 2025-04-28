@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Advertisement</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Advertisement Form</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-10 mx-auto">    
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Add Advertisement</h5>
                    <form class="row g-3" id="advertisementForm" action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <label for="image" class="form-label">Advertisement Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                            <img id="image-preview" src="" class="mt-3 d-none" width="200" style="border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                        </div>

                        <div class="col-md-12">
                            <label for="position" class="form-label">Position</label>
                            <select name="position" id="position" class="form-control" required>
                                <option value="header">Header</option>
                                <option value="sidebar">Sidebar</option>
                                <option value="footer">Footer</option>
                            </select>
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
                                <button type="button" id="submitBtn" class="btn btn-primary px-4">Submit</button>
                                <button type="button" id="resetBtn" class="btn btn-light px-4">Reset</button>
                            </div>
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

    // Preview image function
    function previewImage(event) {
        const image = event.target.files[0];
        if (image) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(image);
        }
    }

    // Submit button with SweetAlert confirmation
    document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Confirm Submission',
            text: 'Are you sure you want to add this advertisement?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('advertisementForm').submit();
            }
        });
    });

    // Reset button with SweetAlert confirmation
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
                document.getElementById('advertisementForm').reset();
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