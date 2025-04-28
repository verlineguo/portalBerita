@extends('admin.layouts.app')

@section('content')
<style>
    #commentsTable {
        border: none !important;
    }
    #commentsTable th, #commentsTable td {
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Comments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Comments</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <h4 class="mb-0 text-uppercase">All Comments</h4>
    <hr/>

    <div class="card">
        @if (session('success'))
            <div class="alert alert-success my-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table id="commentsTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ Str::limit($comment->comment, 50) }}</td>
                            <td>
                                @if ($comment->status)
                                    <span class="badge bg-success">Visible</span>
                                @else
                                    <span class="badge bg-danger">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <!-- Toggle Status -->
                                <button class="btn btn-sm {{ $comment->status ? 'btn-warning' : 'btn-success' }} toggle-status" data-id="{{ $comment->id }}">
                                    {{ $comment->status ? 'Hide' : 'Show' }}
                                </button>



                                <form action="{{ route('admin.comment.delete', $comment->id) }}"
                                    method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-btn"
                                        data-id="{{ $comment->id }}"><i class="fas fa-trash"></i></button>
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
        $('#commentsTable').DataTable();
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
    

    // Toggle Status
    $('.toggle-status').click(function() {
        let commentId = $(this).data('id');
        $.ajax({
            url: '/admin/comments/toggle/' + commentId,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire('Updated!', 'Comment status has been changed.', 'success');
                location.reload();
            },
            error: function(response) {
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
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
