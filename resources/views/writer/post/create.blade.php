@extends('writer.layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@4.0.1/es2021/jodit.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jodit@4.0.1/es2021/jodit.min.js"></script>
    <!-- Tambahkan di bagian <head> -->
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 3px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: none;
            color: #6c757d;
            border: 1px solid #ced4da;
            border-radius: 3px;
            padding: 4px 8px;
            margin: 3px;
            font-size: 0.875rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #6c757d;
            margin-right: 8px;
            font-weight: bold;
            border-right: 1px solid #ced4da;
            padding-right: 6px;
            position: relative;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .select2-container--default .select2-selection--multiple:focus {
            border-color: #0d6efd;
            outline: 0;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #f8f9fa;
            background: none;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0d6efd;
            color: white;
        }



        .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-results__option {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px;
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
                        <li class="breadcrumb-item"><a href="{{ route('writer.post.manage') }}"><i
                                    class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h5 class="mb-4">Create New Post</h5>
                        <form class="row g-3" action="{{ route('writer.post.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label for="meta-title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="meta-title" name="meta_title"
                                    placeholder="Enter meta title">
                            </div>

                            <div class="col-md-12">
                                <label for="meta-description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" id="meta-description" name="meta_description"
                                    placeholder="Enter meta description">
                            </div>

                            <div class="col-md-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter title">
                            </div>
                            <div class="col-md-12">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                    onchange="previewImage(event)">
                                <img id="image-preview" src="" class="mt-3 d-none" width="200"
                                    style="border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                            </div>


                            <div class="col-md-12">
                                <label for="tags" class="form-label">Tags</label>
                                <select class="form-select select2-tags form-control" name="tags[]" multiple="multiple">
                                    @foreach ($post->tags ?? [] as $tag)
                                        <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Create</button>
                                    <a href="{{ route('writer.post.manage') }}" class="btn btn-secondary px-4">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [','],
            minimumInputLength: 1,
            placeholder: "Tambah atau pilih tag...",
            width: '100%',
            dropdownAutoWidth: true,
            allowClear: true,

            ajax: {
                url: '{{ route('writer.tags.search') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(tag) {
                            return {
                                id: tag.name,
                                text: tag.name
                            };
                        })
                    };
                },
                cache: true
            }
        });


        function previewImage(event) {
            const image = event.target.files[0];
            if (image) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(image);
            }
        }

        function resetPreview() {
            document.getElementById('image-preview').classList.add('d-none');
            document.getElementById('image-preview').src = '';
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editor = new Jodit("#description", {
                height: 500,
                placeholder: "Enter description here...",
            });
        });
    </script>
@endsection
