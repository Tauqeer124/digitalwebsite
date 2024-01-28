<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment StatusS</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card text-center mx-auto" style="max-width: 400px;">
        <div class="card-body">
            @if($payment->status == 'pending')
                <h5 class="card-title text-warning">Pending Verification</h5>
                <p class="card-text">Your payment verification is Pending.. Admin will verify it shortly.</p>
            @elseif($payment->status == 'approved')
                <h5 class="card-title text-success">Payment Approved</h5>
                <p class="card-text">Your payment has been approved. You will be redirected to the home page.</p>
                <script>
                    setTimeout(function () {
                        window.location.href = "{{ route('home') }}";
                    }, 2000); // Redirect after 3 seconds (adjust as needed)
                </script>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
