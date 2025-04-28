@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

<style>

    #datatable {
        border: none !important;
    }
    #datatable th, #datatable td {
        border: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
    }
    /* Hapus background dan border saat hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: none !important;
    border: none !important;
    box-shadow: none !important;
    color: #0d6efd !important; /* Bootstrap primary color */
}

/* Tambahkan hover yang lebih soft (opsional) */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 5px 10px;
    margin: 0 2px;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #e7f1ff !important;
    color: #0d6efd !important;
}

/* Style tombol yang sedang aktif */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #0d6efd !important;
    color: white !important;
    border-radius: 6px;
}


</style>

@endsection

@section('content')

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Messages</li>
                    </ol>
                </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h6 class="mb-0 text-uppercase">Comment</h6>
    <hr/>

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email_address }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>
                                @if ($contact->status == 1)
                                    <span class="badge bg-success">Show</span>
                                @else
                                    <span class="badge bg-danger">Unshow</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.contact.delete', $contact->id) }}"
                                    method="post" 
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-btn"
                                        data-id="{{ $contact->id }}"><i class="fas fa-trash"></i></button>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

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
