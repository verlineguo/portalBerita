@extends('admin.layouts.app')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Advertisement</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Advertisement</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-body p-4">

                        <h5 class="mb-4">Edit Advertisement</h5>
                        <form class="row g-3" id="advertisementForm"
                            action="{{ route('admin.advertisement.update', $advertisement->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <label for="image" class="form-label">Advertisement Image</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                    onchange="previewImage(event)">
                                <img id="image-preview" src="{{ asset('storage/' . $advertisement->image) }}" class="mt-3"
                                    width="200">
                            </div>

                            <div class="col-md-12">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="form-control" required>
                                    <option value="header" {{ $advertisement->position == 'header' ? 'selected' : '' }}>
                                        Header</option>
                                    <option value="sidebar" {{ $advertisement->position == 'sidebar' ? 'selected' : '' }}>
                                        Sidebar</option>
                                    <option value="footer" {{ $advertisement->position == 'footer' ? 'selected' : '' }}>
                                        Footer</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $advertisement->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $advertisement->status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="button" id="submitBtn" class="btn btn-primary px-4">Update</button>
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

        function previewImage(event) {
            const image = event.target.files[0];
            if (image) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(image);
            }
        }

        function resetPreview() {
            document.getElementById('image-preview').src = "{{ asset('uploads/advertisement/' . $advertisement->image) }}";
        }

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
