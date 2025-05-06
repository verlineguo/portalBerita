{{-- resources/views/components/notification-dropdown.blade.php --}}
<div class="dropdown-menu dropdown-menu-end">
    <a href="javascript:;">
        <div class="msg-header">
            <p class="msg-header-title">Notifications</p>
            <form action="{{ route('notifications.markAllAsRead', ['role' => auth()->user()->role]) }}" method="POST">
                @csrf
                <button type="submit" class="msg-header-clear ms-auto border-0 bg-transparent">
                    Mark all as read
                </button>
            </form>
        </div>
    </a>
    <div class="header-notifications-list">
        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
            <a class="dropdown-item" href="{{ url($notification->data['url'] ?? '#') }}" 
               onclick="event.preventDefault(); 
                        document.getElementById('mark-read-{{ $notification->id }}').submit();">
                <div class="d-flex align-items-center">
                    @if(isset($notification->data['comment_id']))
                        <div class="notify bg-light-primary text-primary"><i class="bx bx-message-detail"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">{{ $notification->data['user_name'] }} commented<span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
                            <p class="msg-info">On: {{ Str::limit($notification->data['post_title'], 30) }}</p>
                        </div>
                    @elseif(isset($notification->data['contact_id']))
                        <div class="notify bg-light-danger text-danger"><i class="bx bx-envelope"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">New Contact <span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
                            <p class="msg-info">From: {{ $notification->data['name'] }}</p>
                        </div>
                    @elseif(isset($notification->data['newsletter_id']))
                        <div class="notify bg-light-success text-success"><i class="bx bx-user-plus"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">New Newsletter Subscriber<span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
                            <p class="msg-info">{{ $notification->data['email'] }}</p>
                        </div>
                    @else
                        <div class="notify bg-light-info text-info"><i class="bx bx-bell"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">Notification<span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
                            <p class="msg-info">You have a new notification</p>
                        </div>
                    @endif
                </div>
                <form id="mark-read-{{ $notification->id }}" action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                </form>
            </a>
        @empty
            <div class="dropdown-item">
                <div class="d-flex align-items-center justify-content-center p-3">
                    <p class="mb-0 text-muted">No new notifications</p>
                </div>
            </div>
        @endforelse
    </div>
    <a href="{{ route('notifications.index', ['role' => auth()->user()->role_name]) }}">

        <div class="text-center msg-footer">View All Notifications</div>
    </a>
</div>