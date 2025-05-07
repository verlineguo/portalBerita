@extends('writer.layouts.app')
@section('styles')
<style>
    #commentsTable {
        border: none !important;
    }

    #commentsTable th,
    #commentsTable td {
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
        color: #0d6efd !important;
        /* Bootstrap primary color */
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
@endsection

@section('content')
<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Comments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('writer.dashboard') }}"><i
                                class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Comment</li>
                </ol>
            </nav>
        </div>
    </div>

    <h5 class="mb-3 text-uppercase">Comment Management</h5>


    <div class="card">
     

        <div class="card-body">
            <div class="table-responsive">
                <table id="commentsTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->post->title }}</td>
                            <td>{{ Str::limit($comment->comment, 50) }}</td>
                            <td>
                                @if ($comment->status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($comment->status == 1)
                                    <span class="badge bg-success">Visible</span>
                                @else
                                    <span class="badge bg-danger">Hidden</span>
                                @endif
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
<script>
    $(document).ready(function() {
        $('#commentsTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search comments...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });

    
</script>
@endsection