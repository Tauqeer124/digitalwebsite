<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="48x48" href="public/mlmlogo.png">

    <meta name="author" content="MlM Website">

    <title> @yield('page_title') | {{ config('app.name') }} </title>
    
        <!-- ... other head elements ... -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- ... other head elements ... -->
    
    

    @include('partials.inc_top')
</head>

<body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">

    @include('partials.top_menu')
    <div class="page-content">
        @include('partials.menu')
        <div class="content-wrapper">
            @include('partials.header')

            <div class="content">
                {{-- @if(session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Display error messages -->
                @if(session('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif --}}


                <div id="ajax-alert" style="display: none"></div>

                @yield('content')
            </div>


        </div>
    </div>

    @include('partials.inc_bottom')
    @yield('scripts')
</body>
</html>
<script>
    // Display success message as a Toastr notification
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    // Display error messages as Toastr notifications
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 2000 // Set the time for notifications to be visible (2 seconds in this example)
    };
</script>


