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
                <div class="details" id="package{{ $package->id }}">
                    <p>Name: {{ $package->name }}</p>
                    <p>Price: {{ $package->price }}</p>
                    <p>Commission Percentage: {{ $package->commission_percentage }}</p>
                    <!-- Add more details fields as needed -->
                    <form method="post" action="{{ route('package.buy') }}">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <button type="submit" class="buy-button">Buy</button>
                    </form>
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

    function buyPackage(packageId) {
        // Handle the buy package logic here
        alert('Package ' + packageId + ' purchased!');
    }
</script>

</body>
</html>
