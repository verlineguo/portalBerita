@extends('admin.layouts.app')


@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        #categoryTable {
            border: none !important;
        }

        #categoryTable th,
        #categoryTable td {
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
@endsection
@section('content')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <h5 class="mb-0 text-uppercase">Category Management</h5>
        <hr />

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="categoryTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td>


                                        <a href="{{ route('admin.category.show', $category->id) }}"
                                            class="ms-1 text-warning" style="font-size: 24px;"><i
                                                class="bx bxs-edit"></i></a>

                                        <a href="{{ route('admin.category.delete', $category->id) }}"
                                            class="ms-1 text-danger" style="font-size: 24px;"
                                            onclick="event.preventDefault(); confirmDelete('{{ $category->id }}')">
                                            <i class="bx bxs-trash"></i>
                                        </a>

                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('admin.category.delete', $category->id) }}" method="POST"
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
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable();
        });



        function confirmDelete(categoryId) {
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
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            });
        }

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
    </script>
@endsection
