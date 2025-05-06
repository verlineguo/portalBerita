@extends('admin.layouts.app')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Contact Messages</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.contact.manage') }}">Contact Messages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Message Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h6 class="mb-0 text-uppercase">Message Details</h6>
        <hr />

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">From: {{ $contact->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $contact->email_address }}</p>
                <p class="card-text"><strong>Message:</strong></p>
                <p class="border p-3">{{ $contact->message }}</p>
                <p><strong>Status:</strong>
                    @if ($contact->status == 1)
                        <span class="badge bg-success">Read</span>
                    @else
                        <span class="badge bg-danger">Unread</span>
                    @endif
                </p>
                <a href="{{ route('admin.contact.manage') }}" class="btn btn-secondary">Back</a>
                <form action="{{ route('admin.contact.delete', $contact->id) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-btn" data-id="{{ $contact->id }}">Delete</button>
                </form>



            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });


        $('.delete-btn').on('click', function() {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
