<!-- resources/views/packages/index.blade.php -->

@extends('layouts.master')
@section('page_title', 'All Packages')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">All Packages</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>No of Courses</th>
                        <th>Commission</th>
                        <th>Action</th>

                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->price }}</td>
                            <td>{{ $package->number_of_courses }}</td>
                            <!-- Display more columns as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
