@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')

<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-blue-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">ggggggggggggg</h3>
                                        <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users4 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total Teachers</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users2 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-pointer icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total Administrators</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-user icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total Parents</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <h6>Total Income <small class="text-muted">(last 30 days)</small></h6>
        <div class="card card-body bg-success bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <span class="icon-coin-dollar icon-3x"></span>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total Income</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <h6>Total Expense <small class="text-muted">(last 30 days)</small></h6>
        <div class="card card-body bg-indigo-400 bg-info has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                        <span class="icon-price-tags icon-3x"></span>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total expenses</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <h6>
            
            <small class="text-muted">(last 30 days)</small>
        </h6>
        <div class="card card-body bg-secondary bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                        <span class="icon-credit-card icon-3x"></span>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Total
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection