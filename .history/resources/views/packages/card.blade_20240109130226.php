<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            width: 200px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            cursor: pointer;
            transition: transform 0.3s;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
        }

        .details {
            display: none;
            margin-top: 10px;
        }

        .buy-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        h1 {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<header>
    

    <img class="logo" src="{{ asset('global_assets/images/gwlogo.png') }}" alt="Company Logo">
    <h1>Welcome to Digital Global World. Select one package to continue...</h1>
</header>

<div class="container">
    <div class="card-container">
        @foreach($packages as $package)
            <div class="card" onclick="toggleDetails('{{ $package->id }}')">
                <h3>{{ $package->name }}</h3>
                @if($package->id == 1)
                <p>Get 65% commission</p>
            @elseif($package->id == 2)
                <p>Get 70% commission</p>
            @elseif($package->id == 3)
                <p>Get 75% commission</p>
            @elseif($package->id == 4)
                <p>Get 80% commission</p>
            @endif
                <div class="details" id="package{{ $package->id }}">
                    <p>Name: {{ $package->name }}</p>
                    <p>Price: {{ $package->price }}</p>
                    <p>Commission Percentage: {{ $package->commission_percentage }}</p>
                    
            
                        
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <button type="button" class="buy-button" onclick="buyPackage('{{ route('make.payment') }}', '{{ $package->id }}')">Buy</button>
                
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    var openDetailsId = null;

    function toggleDetails(packageId) {
        var details = document.getElementById('package' + packageId);
        if (openDetailsId && openDetailsId !== packageId) {
            var previousDetails = document.getElementById('package' + openDetailsId);
            previousDetails.style.display = 'none';
        }
        details.style.display = details.style.display === 'none' ? 'block' : 'none';
        openDetailsId = details.style.display === 'none' ? null : packageId;
    }

    function buyPackage(paymentRoute, packageId) {
        // Navigate to the make.payment route with the packageId
        window.location.href = paymentRoute + "?package_id=" + packageId;
    }
</script>

</body>
</html>
