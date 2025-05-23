@extends('admin.layouts.app')

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
            <div class="breadcrumb-title pe-3">Posts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.post.manage') }}">Post</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Post Details</h5>
                <div>
                    <a href="{{ route('admin.post.manage') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                    <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-sm btn-warning text-white">
                        <i class="bx bx-edit"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="{{ asset($post->image) }}" class="img-fluid rounded"
                                alt="{{ $post->title }}">
                            <div class="position-absolute bottom-0 end-0 p-2">
                                <span class="badge bg-{{ $post->status ? 'success' : 'warning' }}">
                                    {{ $post->status ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <h6 class="text-muted mb-2">Meta Information</h6>
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <small class="text-muted">Meta Title:</small>
                                        <p class="mb-1">{{ $post->meta_title }}</p>
                                    </div>
                                    <div>
                                        <small class="text-muted">Meta Description:</small>
                                        <p class="mb-0">{{ $post->meta_description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="mb-2">{{ $post->title }}</h4>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary">{{ $post->category->name }}</span>
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-info">{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bx bx-user me-1"></i>
                                <span>{{ $post->writer->name }}</span>
                                <i class="bx bx-calendar ms-3 me-1"></i>
                                <span>{{ $post->created_at->format('d M Y, H:i') }}</span>
                                <i class="bx bx-show ms-3 me-1"></i>
                                <span>{{ $post->views }} views</span>
                                <i class="bx bx-message ms-3 me-1"></i>
                                <span>{{ $post->comments }} comments</span>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Slug:</small>
                                <code>{{ $post->slug }}</code>
                            </div>
                        </div>

                        <div class="post-content border-top pt-3">
                            <h6 class="text-muted mb-2">Content</h6>
                            <div class="content-preview">
                                {!! $post->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <!-- Comments Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Comments ({{ $comments->count() }})
                    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="collapse"
                        data-bs-target="#collapseComments" aria-expanded="true">
                        <i class="bx bx-chevron-down"></i>
                    </button>
                </h5>
            </div>
            <div class="collapse show" id="collapseComments">
                <div class="card-body">
                    @if ($comments->count() > 0)
                        <div class="table-responsive">
                            <table id="commentsTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">User</th>
                                        <th width="50%">Comment</th>
                                        <th width="15%">Date</th>
                                        <th width="10%">Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-info">
                                                        <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                                        <small>{{ $comment->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-sm status-btn dropdown-toggle 
                                                    @if ($comment->status == 0) btn-warning
                                                    @elseif($comment->status == 1) btn-success
                                                    @elseif($comment->status == 2) btn-danger @endif"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if ($comment->status == 0)
                                                            Pending
                                                        @elseif ($comment->status == 1)
                                                            Approved
                                                        @elseif ($comment->status == 2)
                                                            Rejected
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item status-change"
                                                                href="javascript:void(0);" data-id="{{ $comment->id }}"
                                                                data-status="0">
                                                                Pending
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-change"
                                                                href="javascript:void(0);" data-id="{{ $comment->id }}"
                                                                data-status="1">
                                                                Approve
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-change"
                                                                href="javascript:void(0);" data-id="{{ $comment->id }}"
                                                                data-status="2">
                                                                Reject
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.comments.destroy', $comment->id) }}"
                                                        class="ms-1 text-danger" style="font-size: 24px;"
                                                        onclick="event.preventDefault(); confirmDelete('{{ $comment->id }}')">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $comment->id }}"
                                                        action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class='bx bx-message-x fs-1 text-muted'></i>
                            <p class="mt-2">No comments found for this post.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Add DataTables CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#commentsTable').DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search comments...",
                    lengthMenu: "_MENU_ comments per page",
                },
                order: [
                    [3, 'desc']
                ], // Sort by date column (descending)
                pageLength: 10,
                responsive: true
            });

            // Handle Status Change
            $(document).on('click', '.status-change', function() {
                const commentId = $(this).data('id');
                const status = $(this).data('status');
                const button = $(this).closest('td').find('.status-btn');

                $.ajax({
                    url: "{{ route('admin.comments.toggle', ':id') }}".replace(':id', commentId),
                    type: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update button text and class
                            button.text(response.label);
                            button.removeClass('btn-warning btn-success btn-danger');

                            // Add appropriate class based on new status
                            if (response.status == 0) {
                                button.addClass('btn-warning');
                            } else if (response.status == 1) {
                                button.addClass('btn-success');
                            } else if (response.status == 2) {
                                button.addClass('btn-danger');
                            }

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update comment status',
                        });
                    }
                });
            });

            function confirmDelete(advertisementId) {
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
                        document.getElementById('delete-form-' + advertisementId).submit();
                    }
                });
            }

            // Show alerts from session
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
    </script>
@endsection
