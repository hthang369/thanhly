<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', '@Master Layout'))</title>

        <link rel="stylesheet" href="{{ vnn_asset('css/adminlte_v4.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/overlayscrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/admin.css') }}">
        @stack('styles')
        <script async src="{{ vnn_asset('js/app.js') }}"></script>
        <script async src="{{ vnn_asset('js/adminlte_v4.js') }}"></script>
        <script defer src="{{ vnn_asset('js/admin.js') }}"></script>
        <script defer src="{{ vnn_asset('js/tinymce/tinymce.min.js') }}"></script>
        <script defer src="{{ vnn_asset('js/data-grid.js') }}"></script>
    </head>
    <body class="sidebar-mini layout-fixed bg-body-tertiary dark-mode" data-bs-theme="dark">
        {{-- @include('admin::partial.loading') --}}

        <section class="app-wrapper" id="pjax-content-container">
            @include('admin::partial.header')

            <div class="app-main content-wrapper">
                <div class="app-content">
                    @yield('content')
                </div>
            </div>

            @include('admin::partial.footer')
        </section>
    </body>
</html>
