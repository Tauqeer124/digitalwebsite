<!-- resources/views/wallet.blade.php -->
@extends('layouts.master')
@section('page_title', 'My Wallet')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">User Wallet</h6>
    </div>
 
    <div class="card-body">
        @if(count($transactions) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>UserName</th>
                        <th>Total Balance</th>
                        <th>Point Reward</th>
                        <th>Withdraw Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalPoints = 0;
                @endphp
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->total_balance }}</td>
                            <td>{{ $transaction->points_reward }}</td>
                            <td>${{ $transaction->Withdraw_amount }}</td>
                            @php
                            $totalPoints = $transaction->points_reward;
                            
                        @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($totalPoints > 40000)
            <form action="{{ route('convertAndAddToWallet') }}" method="post">
                @csrf
                <input  name="userId" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary">Redeem Points</button>
            </form>
        @endif
        @else
            <p>No records found.</p>
        @endif
    </div>
</div>

@endsection
