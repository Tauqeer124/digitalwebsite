@extends('layouts.master')
@section('page_title', 'Refer Link')
@section('content')
<style>
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



</style>
</head>

@php
$referralLink = 'http://127.0.0.1:8000/register/'.auth()->user()->id;
@endphp
<div class="card mt-3">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Referal Link</h6>
    </div>
    <div class="card-body">

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

        

    </script>

    </html>
    @endsection
