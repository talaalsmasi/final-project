<h3>Notifications</h3>
<ul>
    @forelse ($notifications as $notification)
        <li>
            <p>{{ $notification->data['message'] }}</p>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: blue; cursor: pointer;">Mark as Read</button>
            </form>
        </li>
    @empty
        <li>No new notifications</li>
    @endforelse
</ul>
