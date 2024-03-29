<!-- resources/views/wallet.blade.php -->
@extends('layouts.master')
@section('page_title', 'My Wallet')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">User Wallet</h6>
    </div>
 
    <div class="card-body">
        @php
        
            $totalBalance = App\Models\Wallet::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
         

            $totalPoints = App\Models\Wallet::where('user_id', Auth::user()->id)->sum('points_reward');
            // $totalBalance = App\Models\Wallet::where('user_id', Auth::user()->id)->max('total_balance');

        @endphp

        @if(count($transactions) > 0)
        @if (Auth::user()->isAdmin == 0)
            @if($totalPoints >= 40000)
                <form action="{{ route('convertAndAddToWallet') }}" method="post">
                    @csrf
                    <input hidden name="userId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary">Convert Points</button>
                </form>
            @endif
           
            @if($totalBalance->total_balance >= 50000.00)
            <form action="{{ route('withdrawAmount') }}" method="post">
                @csrf
                <input hidden name="userId" value="{{ Auth::user()->id }}">
              

                <button type="submit" class="btn btn-success">Withdraw $10,000</button>
            </form>
        @elseif($totalBalance->total_balance >= 100000.00)
            <form action="{{ route('withdrawAmount') }}" method="post">
                @csrf
                <input hidden name="userId" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success">Withdraw $20,000</button>
            </form>
        @endif
        @endif

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
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->total_balance }}</td>
                            <td>{{ $transaction->points_reward }}</td>
                            <td>{{ $transaction->withdraw_amount }}</td>
                           
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
