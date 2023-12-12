<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title : 'Article comments example' }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet"  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="referrer" content="origin-when-cross-origin">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/placeholder.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nunito-200-600.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/table-fixed-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />

</head>
    <body class="antialiased p-3 m-0 border-0">
        @include('layouts.nav')
        @yield('content')
        <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js')}}" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>



