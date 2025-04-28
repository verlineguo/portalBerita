@extends('writer.layouts.app')

@section('content')
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

    <h6 class="mb-0 text-uppercase">All Comments</h6>
    <hr/>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">List of Comments</h5>
        </div>

        @if (session('success'))
            <div class="alert alert-success my-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->post->title }}</td>
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
                                <form action="{{ route('admin.comments.toggle', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm {{ $comment->status ? 'btn-warning' : 'btn-success' }}">
                                        {{ $comment->status ? 'Hide' : 'Show' }}
                                    </button>
                                </form>

                                <!-- Delete Comment -->
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">
                                        Delete
                                    </button>
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
