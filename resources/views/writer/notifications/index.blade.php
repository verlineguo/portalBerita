@extends('writer.layouts.app')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Notifications</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('writer.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Notifications</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
                </form>
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
                                        @if(isset($notification->data['comment_id']))
                                            <span class="badge bg-primary">Comment</span>
                                        @else
                                            <span class="badge bg-info">System</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($notification->data['comment_id']))
                                            <strong>{{ $notification->data['user_name'] }}</strong> commented on your post 
                                            "<a href="{{ url($notification->data['url']) }}">{{ $notification->data['post_title'] }}</a>"
                                        @else
                                            {{ $notification->data['message'] ?? 'System notification' }}
                                        @endif
                                    </td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($notification->read_at)
                                            <span class="badge bg-light-secondary text-secondary">Read</span>
                                        @else
                                            <span class="badge bg-light-info text-info">Unread</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if(!$notification->read_at)
                                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="me-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                                </form>
                                            @endif
                                            <a href="{{ url($notification->data['url'] ?? '#') }}" class="btn btn-sm btn-info me-2">View</a>
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
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
@endsection