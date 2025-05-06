@extends('admin.layouts.app')

@section('styles')
    <style>
        #pendingCommentsTable,
        #approvedCommentsTable,
        #rejectedCommentsTable {
            border: none !important;
        }

        #pendingCommentsTable td:nth-child(3),
        #pendingCommentsTable th:nth-child(3),
        #approvedCommentsTable td:nth-child(3),
        #approvedCommentsTable th:nth-child(3),
        #rejectedCommentsTable td:nth-child(3),
        #rejectedCommentsTable th:nth-child(3) {

            white-space: normal;
            /* Izinkan teks turun ke baris berikutnya */
        }

        #pendingCommentsTable th,
        #pendingCommentsTable td,
        #approvedCommentsTable th,
        #approvedCommentsTable td,
        #rejectedCommentsTable th,
        #rejectedCommentsTable td {
            border: none !important;
        }
       

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-approved {
            background-color: #198754;
            color: #fff;
        }

        .badge-rejected {
            background-color: #dc3545;
            color: #fff;
        }

        .nav-tabs {
            border-bottom: 2px solid #f0f0f0;
        }

        .nav-tabs .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
            padding: 10px 20px;
            font-weight: 500;
            color: #6c757d;
            margin-bottom: -2px;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            border-bottom: 2px solid #0d6efd;
        }

        .tab-icon {
            margin-right: 8px;
        }

        .comment-truncate {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Comments</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Comments</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h5 class="mb-0 text-uppercase">Post Management</h5>
        <hr />


        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-time-five"></i></div>
                                <div class="tab-title">Pending ({{ $pendingCount }})</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#approved" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-check-circle"></i></div>
                                <div class="tab-title">Approved ({{ $approvedCount }})</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#rejected" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-x-circle"></i></div>
                                <div class="tab-title">Rejected ({{ $rejectedCount }})</div>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        <div class="table-container">
                            <table id="pendingCommentsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Post</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingComments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td><a href="{{ url('/post/' . $comment->post->slug) }}" target="_blank"
                                                    class="text-primary">{{ Str::limit($comment->post->title, 30) }}</a>
                                            </td>
                                            <td class="comment-truncate">{{ $comment->comment }}</td>
                                            <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="action-btns d-flex">
                                                    <a href="javascript:;" class="text-success approve-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Approve Comment">
                                                        <i class="bx bxs-check-circle"></i>
                                                    </a>
                                                    <a href="javascript:;" class="text-warning reject-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Reject Comment">
                                                        <i class="bx bxs-x-circle"></i>
                                                    </a>
                                                    <a href="javascript:;" class="text-danger delete-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Delete Comment">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                    <form id="approve-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.approve', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <form id="reject-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.reject', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <form id="delete-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.delete', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No pending comments found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="approved" role="tabpanel">
                        <div class="table-container">
                            <table id="approvedCommentsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Post</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($approvedComments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td><a href="{{ url('/post/' . $comment->post->slug) }}" target="_blank"
                                                    class="text-primary">{{ Str::limit($comment->post->title, 30) }}</a>
                                            </td>
                                            <td class="comment-truncate">{{ $comment->comment }}</td>
                                            <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="action-btns d-flex">
                                                    <a href="javascript:;" class="text-warning reject-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Reject Comment">
                                                        <i class="bx bxs-x-circle"></i>
                                                    </a>
                                                    <a href="javascript:;" class="text-danger delete-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Delete Comment">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                    <form id="reject-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.reject', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <form id="delete-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.delete', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No approved comments found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rejected" role="tabpanel">
                        <div class="table-container table-responsive">
                            <table id="rejectedCommentsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Post</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rejectedComments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td><a href="{{ url('admin/post/' . $comment->post->slug) }}" target="_blank"
                                                    class="text-primary">{{ Str::limit($comment->post->title, 30) }}</a>
                                            </td>
                                            <td class="comment-truncate">{{ $comment->comment }}</td>
                                            <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="action-btns d-flex">
                                                    <a href="javascript:;" class="text-success approve-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Approve Comment">
                                                        <i class="bx bxs-check-circle"></i>
                                                    </a>
                                                    <a href="javascript:;" class="text-danger delete-comment-btn"
                                                        data-comment-id="{{ $comment->id }}" data-bs-toggle="tooltip"
                                                        title="Delete Comment">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                    <form id="approve-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.approve', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <form id="delete-comment-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.delete', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No rejected comments found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Preview Modal -->
        <div class="modal fade" id="commentPreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Comment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>User:</strong> <span id="modal-user"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Post:</strong> <span id="modal-post"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Date:</strong> <span id="modal-date"></span>
                        </div>
                        <div>
                            <strong>Comment:</strong>
                            <p id="modal-comment" class="mt-2 p-3 bg-light rounded"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Make sure jQuery is ready before executing scripts
document.addEventListener('DOMContentLoaded', function() {
    // Wait until jQuery is defined
    function waitForJQuery() {
        if (window.jQuery) {
            // jQuery is loaded, proceed with initialization
            initializeScripts();
        } else {
            // Wait 100ms and try again
            setTimeout(waitForJQuery, 100);
        }
    }
    
    // Start checking if jQuery is available
    waitForJQuery();
});

// Main initialization function that runs once jQuery is available
function initializeScripts() {
    console.log('Document ready function executing');
    
    // Initialize tooltips
    try {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        console.log('Tooltips initialized');
    } catch(e) {
        console.error('Error initializing tooltips:', e);
    }

    // Configure DataTables options - we'll use these for all tables
    const dataTableOptions = {
        responsive: true,
        pageLength: 10,
        language: {
            search: "<i class='bx bx-search'></i> Search:",
            lengthMenu: "_MENU_ comments per page",
            info: "Showing _START_ to _END_ of _TOTAL_ comments",
            paginate: {
                first: "<i class='bx bx-chevrons-left'></i>",
                last: "<i class='bx bx-chevrons-right'></i>",
                next: "<i class='bx bx-chevron-right'></i>",
                previous: "<i class='bx bx-chevron-left'></i>"
            }
        },
        // Add drawCallback to adjust columns on draw
        drawCallback: function() {
            $(this).find('td, th').addClass('align-middle');
        }
    };

    // Initialize DataTables for the active tab first
    try {
        // Find which tab is active on page load
        const activeTabId = $('.tab-pane.active').attr('id');
        console.log('Active tab on load:', activeTabId);
        
        // Initialize the table in the active tab first
        if (activeTabId === 'pending') {
            $('#pendingCommentsTable').DataTable(dataTableOptions);
            console.log('Pending comments table initialized');
        } else if (activeTabId === 'approved') {
            $('#approvedCommentsTable').DataTable(dataTableOptions);
            console.log('Approved comments table initialized');
        } else if (activeTabId === 'rejected') {
            $('#rejectedCommentsTable').DataTable(dataTableOptions);
            console.log('Rejected comments table initialized');
        }
    } catch(e) {
        console.error('Error initializing active DataTable:', e);
    }

    // Handle tab changes and initialize tables when they become visible
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        const targetTab = $(e.target).attr('href').substring(1);
        console.log('Tab changed to:', targetTab);
        
        try {
            // Check if DataTable is already initialized
            const tableId = '#' + targetTab + 'CommentsTable';
            if (!$.fn.dataTable.isDataTable(tableId)) {
                // Initialize the table if not already done
                $(tableId).DataTable(dataTableOptions);
                console.log(targetTab + ' comments table initialized');
            } else {
                // Just adjust columns if already initialized
                $(tableId).DataTable().columns.adjust();
                console.log(targetTab + ' table columns adjusted');
            }
        } catch(e) {
            console.error('Error handling tab change for ' + targetTab + ':', e);
        }
    });

    // Show full comment on click
    try {
        $(document).on('click', '.comment-truncate', function() {
            const comment = $(this).text();
            const user = $(this).closest('tr').find('td:nth-child(2)').text();
            const post = $(this).closest('tr').find('td:nth-child(3)').text();
            const date = $(this).closest('tr').find('td:nth-child(5)').text();

            $('#modal-user').text(user);
            $('#modal-post').text(post);
            $('#modal-date').text(date);
            $('#modal-comment').text(comment);

            $('#commentPreviewModal').modal('show');
            console.log('Comment preview modal shown');
        });
    } catch(e) {
        console.error('Error setting up comment preview:', e);
    }

    // SweetAlert for approve action
    try {
        $(document).on('click', '.approve-comment-btn', function(e) {
            e.preventDefault();
            const commentId = $(this).data('comment-id');
            console.log('Approve button clicked for comment ID:', commentId);

            Swal.fire({
                title: 'Approve Comment',
                text: "This comment will be visible to all users",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-comment-' + commentId).submit();
                }
            });
        });
    } catch(e) {
        console.error('Error setting up approve buttons:', e);
    }

    // SweetAlert for reject action
    try {
        $(document).on('click', '.reject-comment-btn', function(e) {
            e.preventDefault();
            const commentId = $(this).data('comment-id');
            console.log('Reject button clicked for comment ID:', commentId);

            Swal.fire({
                title: 'Reject Comment',
                text: "This comment will not be visible to users",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reject-comment-' + commentId).submit();
                }
            });
        });
    } catch(e) {
        console.error('Error setting up reject buttons:', e);
    }

    // SweetAlert for delete action
    try {
        $(document).on('click', '.delete-comment-btn', function(e) {
            e.preventDefault();
            const commentId = $(this).data('comment-id');
            console.log('Delete button clicked for comment ID:', commentId);

            Swal.fire({
                title: 'Delete Comment',
                text: "This action cannot be undone!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-comment-' + commentId).submit();
                }
            });
        });
    } catch(e) {
        console.error('Error setting up delete buttons:', e);
    }

    // Show success message with SweetAlert (for redirects with session data)
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
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
}
   </script>
@endsection
