@extends('admin.layouts.app')

@section('content')
    <style>
        #postsTable {
            border: none !important;
        }

        #postsTable th,
        #postsTable td {
            border: none !important;
        }


        #postsTable td:nth-child(3),
        #postsTable th:nth-child(3) {
     
            white-space: normal;
            /* Izinkan teks turun ke baris berikutnya */
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
                        <li class="breadcrumb-item active" aria-current="page">Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <h5 class="mb-0 text-uppercase">Post Management</h5>
        <hr />
        <div class="ms-auto d-flex mb-3 justify-content-between">
            <!-- Dropdown Filter Role -->
            <form method="GET" action="{{ route('admin.post.manage') }}">
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <div class="btn-group">
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Tabel -->
                <div class="table-responsive">
                    <table id="postsTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Writer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>
                                        <img src="{{ asset('storage/' . $post->image) }}" width="200"
                                            alt="Advertisement Image">
                                    </td> --}}

                                    <td>
                                        <img src="{{ $post->image) }}" width="200"
                                            alt="Post Image">
                                    </td>

                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                                    <td>{{ $post->writer->name ?? 'Unknown' }}</td>
                                    <td>
                                        @if ($post->status == 1)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.post.show', $post->id) }}" class="ms-1 text-warning"
                                            style="font-size: 24px;"><i class="bx bxs-edit"></i></a>
                                        <a href="{{ route('admin.post.detail', $post->id) }}"class="ms-1 text-primary"
                                            style="font-size: 24px;"><i class="bx bxs-show"></i></a>
                                        <a href="{{ route('admin.post.delete', $post->id) }}" class="ms-1 text-danger"
                                            style="font-size: 24px;"
                                            onclick="event.preventDefault(); confirmDelete('{{ $post->id }}')">
                                            <i class="bx bxs-trash"></i>
                                        </a>

                                        <form id="delete-form-{{ $post->id }}"
                                            action="{{ route('admin.post.delete', $post->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
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
        // Initialize DataTable
        $(document).ready(function() {
            $('#postsTable').DataTable();
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



       

        function confirmDelete(postId) {
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
                    document.getElementById('delete-form-' + postId).submit();
                }
            });
        }
    </script>
@endsection
