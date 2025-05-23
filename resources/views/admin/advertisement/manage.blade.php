@extends('admin.layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        #advertisementTable {
            border: none !important;
        }

        #advertisementTable th,
        #advertisementTable td {
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
            <div class="breadcrumb-title pe-3">Advertisement</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Advertisement</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>

        <h5 class="mb-0 text-uppercase">Advertisement Management</h5>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="advertisementTable" class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advertisements as $advertisement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($advertisement->image) }}" width="200"
                                            alt="Advertisement Image">
                                    </td>
                                    <td>{{ ucfirst($advertisement->position) }}</td>
                                    <td>
                                        @if ($advertisement->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.advertisement.show', $advertisement->id) }}"
                                            class="ms-1 text-warning" style="font-size: 24px;"><i
                                                class="bx bxs-edit"></i></a>


                                        <a href="{{ route('admin.advertisement.delete', $advertisement->id) }}"
                                            class="ms-1 text-danger" style="font-size: 24px;"
                                            onclick="event.preventDefault(); confirmDelete('{{ $advertisement->id }}')">
                                            <i class="bx bxs-trash"></i>
                                        </a>

                                        <form id="delete-form-{{ $advertisement->id }}"
                                            action="{{ route('admin.advertisement.delete', $advertisement->id) }}"
                                            method="POST" style="display: none;">
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
            $('#advertisementTable').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: "Search advertisements..."
                },
                pagingType: "simple_numbers"

            });



        });

        // Display SweetAlert for success messages
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

        // Image preview on hover
        $(document).on('click', 'td img', function() {
            let src = $(this).attr('src');
            Swal.fire({
                imageUrl: src,
                imageAlt: 'Advertisement Image',
                showConfirmButton: false,
                showCloseButton: true,
                width: 'auto',
                padding: '1em',
                background: '#fff',
                timer: 3000
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
    </script>
@endsection
