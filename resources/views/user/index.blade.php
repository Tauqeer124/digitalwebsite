<!-- resources/views/packages/index.blade.php -->

@extends('layouts.master')
@section('page_title', 'All Users')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">All Users</h6>
    </div>
    <div class="card-body">
        @if(count($users) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>reffer_id</th>
                    <th>status</th>
                    <th>Action</th>


                    <!-- Add more columns as needed -->
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
                    <td>{{ $user->status}}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('user.delete', $user->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>

                    <!-- Display more columns as needed -->
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No records found.</p>
        @endif
    </div>
</div>

@endsection
