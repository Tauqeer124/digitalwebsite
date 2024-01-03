@extends('layouts.master')
@section('page_title', 'Payment Status')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">All Payments</h6>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Trans_ID</th>
                    <th>Account_type</th>
                    <th>Account_title</th>
                    <th>Accont_no</th>

                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user_id }}</td>
                        <td>{{ $payment->transcation_id }}</td>
                        <td>{{ $payment->account_type }}</td>
                        <td>{{ $payment->account_title }}</td>
                        <td>{{ $payment->account_no}}</td>
                        <td>
                            <img src="{{ asset('payment_screenshots/' . $payment->image) }}" alt="Payment Screenshot" style="max-width: 100px;">
                        </td>
                        <td>
                            <span class="badge badge-{{ $payment->status === 'approved' ? 'success' : 'danger' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @if($payment->status !== 'approved')
                                    <form action="{{ route('admin.changePaymentStatus', ['paymentId' => $payment->id, 'newStatus' => 'approved']) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                @endif
                                @if($payment->status == 'approved')

                                <form action="{{ route('admin.changePaymentStatus', ['paymentId' => $payment->id, 'newStatus' => 'rejected']) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
