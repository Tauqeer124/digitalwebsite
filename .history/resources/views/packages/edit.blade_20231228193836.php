<!-- resources/views/packages/edit.blade.php -->

@extends('layouts.master')
@section('page_title', 'Edit Package')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Package</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('packages.update', $package->id) }}">
                @csrf
                @method('put')

                <div class="form-group row">
                    <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="name" name="name" required type="text" class="form-control" value="{{ $package->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-lg-3 col-form-label font-weight-semibold">Price <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="price" name="price" required type="number" class="form-control" value="{{ $package->price }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_of_courses" class="col-lg-3 col-form-label font-weight-semibold">No Of Courses <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="number_of_courses" name="number_of_courses" required type="number" class="form-control" value="{{ $package->number_of_courses }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="commission" class="col-lg-3 col-form-label font-weight-semibold">No Of Courses <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input id="comission" name="commission_percentage" required type="number" class="form-control" value="{{ $package-> }}">
                    </div>
                </div>

                <!-- Add more fields as needed -->

                <div class="text-right">
                    <button type="submit" class="btn btn-danger">Update Package <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

@endsection
