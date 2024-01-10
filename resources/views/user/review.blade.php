@extends('layouts.master')
@section('page_title', 'Review Users')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Review Users</h6>
        </div>
        <div class="card-body">
            @if(count($users) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Reffer_id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone}}</td>
                            <td>{{ $user->referrer_id ?? '0' }}</td>
                            
                            <td>
                                <form id="statusForm_{{ $user->id }}" action="{{ route('user.updateStatus', ['user' => $user->id]) }}" method="post">
                                    @csrf
                                    <select class="form-control" name="status" onchange="submitStatusForm('{{ $user->id }}', this.value)">
                                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="block" {{ $user->status == 'block' ? 'selected' : '' }}>Block</option>
                                        <option value="review" {{ $user->status == 'review' ? 'selected' : '' }}>Review</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                                          
                                <form action="{{ route('user.delete', $user->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No records found.</p>
            @endif
        </div>
    </div>

    <script>
        function submitStatusForm(userId, selectedStatus) {
            // Update the status in the database via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ url('/user/update-status') }}/' + userId,


                data: {
                    _token: '{{ csrf_token() }}',
                    status: selectedStatus
                },
                success: function (data) {
                    // Assuming the response is { success: true }
                    if (data.success) {
                        // Update the status displayed in the table
                        $('#status_' + userId).text(selectedStatus);
                        location.reload();

                    }
                },
                error: function (data) {
                    // Handle errors if any
                }
            });
        }
    </script>

@endsection
