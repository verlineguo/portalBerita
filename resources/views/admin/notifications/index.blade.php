@extends('admin.layouts.app')

@section('styles')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .btn-sm {
            background: transparent;
            border: none;
            box-shadow: none;
        }
    </style>
@endsection

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Notifications</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Notifications</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <button type="button" id="markAllAsReadBtn" class="btn btn-sm btn-primary">Mark All as Read</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $notification)
                                <tr class="{{ $notification->read_at ? '' : 'bg-light-info bg-opacity-25' }}">
                                    <td>
                                        @if (isset($notification->data['comment_id']))
                                            <span class="badge bg-primary">Comment</span>
                                        @elseif(isset($notification->data['contact_id']))
                                            <span class="badge bg-danger">Contact</span>
                                        @elseif(isset($notification->data['newsletter_id']))
                                            <span class="badge bg-success">Newsletter</span>
                                        @else
                                            <span class="badge bg-info">System</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($notification->data['post_id']))
                                            <strong>{{ $notification->data['writer_name'] }}</strong> published a new post:
                                            "<a
                                                href="{{ url($notification->data['url']) }}">{{ $notification->data['title'] }}</a>"
                                        @elseif(isset($notification->data['comment_id']))
                                            <strong>{{ $notification->data['user_name'] }}</strong> commented on post
                                            "<a
                                                href="{{ url($notification->data['url']) }}">{{ $notification->data['post_title'] }}</a>"
                                        @elseif(isset($notification->data['contact_id']))
                                            New contact form submission from
                                            <strong>{{ $notification->data['name'] }}</strong> with subject:
                                            "<a
                                                href="{{ url($notification->data['url']) }}">{{ $notification->data['subject'] }}</a>"
                                        @elseif(isset($notification->data['newsletter_id']))
                                            New newsletter subscription from
                                            <strong>{{ $notification->data['email'] }}</strong>
                                        @else
                                            {{ $notification->data['message'] ?? 'System notification' }}
                                        @endif
                                    </td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($notification->read_at)
                                            <span class="badge bg-light-secondary text-secondary">Read</span>
                                        @else
                                            <span class="badge bg-light-info text-info">Unread</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if (!$notification->read_at)
                                                <button type="button" style="font-size: 24px;" class="btn btn-sm btn-light mark-read-btn"
                                                    data-id="{{ $notification->id }}" title="Mark as Read">
                                                    <i class="bx bx-check-circle text-primary"></i>
                                                </button>
                                            @endif
                                            <a href="{{ url($notification->data['url'] ?? '#') }}"
                                                class="btn btn-sm" title="View" style="font-size: 24px;">
                                                <i class="bx bx-show text-info"></i>
                                            </a>
                                            <button type="button" style="font-size: 24px;" class="btn btn-sm delete-btn"
                                                data-id="{{ $notification->id }}" title="Delete">
                                                <i class="bx bx-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No notifications found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>


<!-- Hidden Forms for Sweet Alert actions -->
<form id="markAllForm" action="{{ route('notifications.markAllAsRead') }}" method="POST" style="display: none;">
    @csrf
</form>

<form id="markReadForm" method="POST" style="display: none;">
    @csrf
    @method('PUT')
</form>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Mark All as Read button
        document.getElementById('markAllAsReadBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Mark all as read?',
                text: 'Are you sure you want to mark all notifications as read?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark all!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('markAllForm').submit();
                }
            });
        });

        // Handle Mark as Read buttons
        document.querySelectorAll('.mark-read-btn').forEach(button => {
            button.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-id');
                const form = document.getElementById('markReadForm');
                form.action = "{{ route('notifications.markAsRead', '') }}/" + notificationId;

                Swal.fire({
                    title: 'Mark as read?',
                    text: 'Are you sure you want to mark this notification as read?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, mark it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Handle Delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-id');
                const form = document.getElementById('deleteForm');
                form.action = "{{ route('notifications.destroy', '') }}/" + notificationId;

                Swal.fire({
                    title: 'Delete notification?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Display flash messages using SweetAlert
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endsection