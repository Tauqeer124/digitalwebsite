<!-- resources/views/admin/add-points-form.blade.php -->
@extends('layouts.master')
@section('page_title', 'Add Points')
@section('content')
    <div class="container mt-4">
        <h2 class="mt-3">Add Points to {{ $user->name }}</h2>

        <form method="post" action="{{ route('admin.addPoints', ['user' => $user->id]) }}" class="mt-3">
            @csrf

            <div class="form-group">
                <label for="points">Points:</label>
                <input type="number" name="points" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Points</button>
        </form>
    </div>
@endsection
