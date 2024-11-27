<div class="container">
    <h2>Your Taxi Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>User ID</th>
                <th>Trip Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user_id }}</td>
                    <td>{{ ucfirst($request->trip_type) }}</td>
                    <td>{{ $request->price }} JD</td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($request->status == 'completed')
                            <span class="badge badge-primary">Completed</span>
                        @endif
                    </td>
                    <td>
                        <!-- زر لتغيير الحالة -->
                        @if($request->status == 'pending')
                            <form action="{{ route('driver.requests.changeStatus', ['id' => $request->id, 'status' => 'approved']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                        @elseif($request->status == 'approved')
                            <form action="{{ route('driver.requests.changeStatus', ['id' => $request->id, 'status' => 'completed']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Complete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
