<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="referrer" content="strict-origin"/> --}}
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <title>{{ trans('auth.login_page_title') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    @stack('cssinline')

</head>
<body>
    {{-- @include(layouts_path('home', 'partial.navigation')) --}}

    <main class="w-100">
        @yield('content')
    </main>

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('jsinline')
</body>
</html>
