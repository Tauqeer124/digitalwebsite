<!-- resources/views/admin/add-points-form.blade.php -->

@extends('layouts.app')  {{-- Assuming you have a master layout --}}

@section('content')
    <div class="container">
        <h2>Add Points to {{ $user->name }}</h2>

        <form method="post" action="{{ route('admin.addPoints', ['user' => $user->id]) }}">
            @csrf

            <label for="points">Points:</label>
            <input type="number" name="points" required>

            <button type="submit">Add Points</button>
        </form>
    </div>
@endsection
