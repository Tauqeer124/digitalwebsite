<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="public/mlmlogo.png">

    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background: url('https://static-communitytable.parade.com/wp-content/uploads/2014/03/rethink-target-heart-rate-number-ftr.jpg') fixed;
            background-size: cover;
        }

        *[role="form"] {
            max-width: 600px;
            padding: 15px;
            margin: 0 auto;
            border-radius: 0.3em;
            background-color: #f2f2f2;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        *[role="form"] h2 { 
            font-family: 'Open Sans', sans-serif;
            font-size: 40px;
            font-weight: 600;
            color: #000000;
            margin-top: 5%;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        @csrf <!-- Add this line to include CSRF token -->
        <h2>Login</h2>
        
        @if ($errors->any())
        <div class="alert alert-danger alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ session('error') }}</span>
        </div>
        @endif
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email* </label>
            <div class="col-sm-9">
                <input type="email" id="email" placeholder="Email" class="form-control" name="email" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password*</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Password" name="password" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <p class="text-center"> <a href="{{route('register-form')}}">Register here</a></p>
    </form>
</div>

</body>
</html>
