<!doctype html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $primaryColor = config('install.colors.primary');
        $secondaryColor = config('install.colors.secondary');
        $boxRgba = config('install.colors.boxRgba');
    @endphp
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
        }
    </style>
    <link href="{{ asset('install/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('install/style.css') }}" rel="stylesheet">
    <link href="{{ asset('install/bootstrap-icons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>

<body>
    @include('vendor.InstallerEragViews.step')
    @yield('content')
</body>

</html>
