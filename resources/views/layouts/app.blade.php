<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <navbar></navbar>
    {{--@include('layouts.home')--}}
    {{--@include('layouts.login')--}}
    {{--@include('layouts.register')--}}
    {{--@include('layouts.profile')--}}

    @yield('content')

    <div class="mt-5"></div>
</div>

<script>
  const apiToken = '{{ auth()->user() ? auth()->user()->api_token : '' }}';
  const username = '{{ auth()->user() ? auth()->user()->username : '' }}';
</script>

<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
