@extends('layouts.master')
@section('page_title', 'Add Package')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">My Account</h6>
        
    </div>
   
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#change-pass" class="nav-link active" data-toggle="tab">Change Password</a></li>
            
                <li class="nav-item"><a href="#edit-profile" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Manage Profile</a></li>
            
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="change-pass">
                <div class="row">
                    <div class="col-md-8">
                        <form method="post" action="{{ route('package.store') }}">
                            @csrf 

                            <div class="form-group row">
                                <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Name<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input id="name" name="name"  required type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="courses" class="col-lg-3 col-form-label font-weight-semibold">No Of Courses<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input id="password" name="password"  required type="password" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input id="password_confirmation" name="password_confirmation"  required type="password" class="form-control" >
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
                
            
        </div>
    </div>
</div>


@endsection