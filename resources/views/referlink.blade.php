<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refer a Friend</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Added flex-direction property */
            align-items: center;
            justify-content: flex-start; /* Align items at the top */
            height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
            margin-top: 20px; /* Add margin to the top */
        }

        h1 {
            color: #333;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: #666;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        
        button.back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        button.back-button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    @php 
    $referralLink = 'http://127.0.0.1:8000/register/'.auth()->user()->id;
    @endphp
    <button class="back-button" onclick="goBack()">Back</button>
    <div class="container">
        <h1>Refer a Friend</h1>

        <input type="text" id="referralLinkInput" value="{{ $referralLink }}" readonly>

        <button onclick="copyToClipboard()">Copy Link</button>

        <p>Your reference number is:</p>
        <h2>{{ auth()->user()->phone }}</h2>

        <p>Enjoy the Digital Website ! <a href="{{ $referralLink }}">{{ $referralLink }}</a></p>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("referralLinkInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied the referral link: " + copyText.value);
        }
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
