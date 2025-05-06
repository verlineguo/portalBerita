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

        /* Remove background and border on hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            color: #0d6efd !important;
        }

        /* Add softer hover (optional) */
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

        /* Style active button */
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
            <div class="breadcrumb-title pe-3">My Posts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('writer.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('writer.post.manage') }}">My Posts</a>
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
                    <a href="{{ route('writer.post.manage') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                    <a href="{{ route('writer.post.show', $post->id) }}" class="btn btn-sm btn-warning text-white">
                        <i class="bx bx-edit"></i> Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded"
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
                                <i class="bx bx-calendar me-1"></i>
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
                                        <th width="55%">Comment</th>
                                        <th width="15%">Date</th>
                                        <th width="10%">Status</th>
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
                                                <span class="badge bg-{{ $comment->status == 0 ? 'warning' : ($comment->status == 1 ? 'success' : 'danger') }}">
                                                    {{ $comment->status == 0 ? 'Pending' : ($comment->status == 1 ? 'Approved' : 'Rejected') }}
                                                </span>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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