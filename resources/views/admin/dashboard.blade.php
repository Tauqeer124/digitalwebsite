@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')

<div class="row">
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body bg-blue-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{ $total_package }}</h3>
                                        <span class="text-uppercase font-size-xs font-weight-bold">Total Packages</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users4 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{$refer}}</h3>
                    <span class="text-uppercase font-size-xs">Total Refferrs</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users2 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{$point}}</h3>
                    <span class="text-uppercase font-size-xs">Total Points Earned</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-user icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
  

   
    <div class="col-sm-6 col-xl-4">
        <h6>Total Income <small class="text-muted">(last 30 days)</small></h6>
        <div class="card card-body bg-success bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <span class="icon-coin-dollar icon-3x"></span>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0">{{ $balance->total_balance }}</h3>
                    <span class="text-uppercase font-size-xs">Wallet balance</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <h6>Total Withdraw<small class="text-muted">(last 30 days)</small></h6>
        <div class="card card-body bg-indigo-400 bg-info has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                        <span class="icon-price-tags icon-3x"></span>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0">{{$withdraw}}</h3>
                    <span class="text-uppercase font-size-xs">Total withdraw</span>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection