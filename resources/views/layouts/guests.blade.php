<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/3.44.2/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.44.2/js/hosted-fields.min.js"></script>
</head>
<body>
    <div id="app">
        @include('layouts.partials.header')

        <main class="">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
</body>
</html>
