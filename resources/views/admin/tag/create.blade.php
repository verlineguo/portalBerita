@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">tag</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">tag Form</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                        <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-body p-4">

                        <h5 class="mb-4">Add tag</h5>
                        <form class="row g-3" id="tagForm" action="{{ route('admin.tag.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label for="name" class="form-label">tag Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Enter your tag">
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
                                    <button type="submit" id="submitBtn" class="btn btn-primary px-4">Submit</button>
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