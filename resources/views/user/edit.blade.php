<!-- resources/views/packages/edit.blade.php -->

@extends('layouts.master')
@section('page_title', 'Edit User')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit User</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('put')

                <div class="form-group row">
                    <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="name" name="name" required type="text" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-lg-3 col-form-label font-weight-semibold">Phone <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="phone" name="phone" required type="tel" class="form-control" value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_of_courses" class="col-lg-3 col-form-label font-weight-semibold">Email <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="email" name="email" required  readonly type="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="commission" class="col-lg-3 col-form-label font-weight-semibold">Referred By<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="referred_id" name="referred_id" required type="number" class="form-control" value="{{ $user->referrer_id }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="status" class="col-lg-3 col-form-label font-weight-semibold">Status<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select id="status" name="status" required class="form-control">
                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="block" {{ $user->status === 'block' ? 'selected' : '' }}>Block</option>
                            <option value="review" {{ $user->status === 'review' ? 'selected' : '' }}>Review</option>
                        </select>
                    </div>
                </div>

                <!-- Add more fields as needed -->

                <div class="text-right">
                    <button type="submit" class="btn btn-success">Update User<i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

@endsection
