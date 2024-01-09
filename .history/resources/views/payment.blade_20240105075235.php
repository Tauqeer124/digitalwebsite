<!-- payment.blade.php -->

@extends('layouts.master')
@section('page_title', 'Submit Payment')
@section('content')

<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Submit Payment</h5>
        </div>
        <div class="card-body">
            <!-- Display company's account information -->
            <div class="mb-3">
                <p><strong>Company Account Information:</strong></p>
                <p>Account Title: {{ $accountTitle }}</p>
                <p>Account Number: {{ $accountNumber }}</p>
            </div>

            <!-- Form to submit payment -->
            <form action="{{ route('submitPayment') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="number" class="form-control" name="package_id" value="{{ $packageId }}"> 

                <div class="mb-3">
                    <label for="transaction_id" class="form-label">Transaction ID:</label>
                    <input type="number" class="form-control" name="transcation_id" required>
                </div>

                <div class="mb-3">
                    <label for="account_type" class="form-label">Account Type:</label>
                    <select class="form-control" name="account_type" required>
                        <option value="Bank">Bank</option>
                        <option value="Jazz-Cash">Jazz-Cash</option>
                        <option value="Easypaisa">Easypaisa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="account_title" class="form-label">Account Title:</label>
                    <input type="text" class="form-control" name="account_title" required>
                </div>

                <div class="mb-3">
                    <label for="account_number" class="form-label">Account Number:</label>
                    <input type="number" class="form-control" name="account_no" required>
                </div>

                <div class="mb-3">
                    <label for="screenshot" class="form-label">Transaction Screenshot:</label>
                    <input type="file" class="form-control" name="image" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form>
        </div>
    </div>
</div>

@endsection
