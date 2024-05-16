<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', '@Master Layout'))</title>

        {{-- <link rel="stylesheet" href="{{ vnn_asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ vnn_asset('css/adminlte_v4.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/overlayscrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/admin.css') }}">
        {{-- <link rel="stylesheet" href="{{ vnn_asset('css/coreui.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ vnn_asset('css/bootstrap-multiselect.min.css') }}"> --}}
        @stack('styles')
        <script async src="{{ vnn_asset('js/app.js') }}"></script>
        {{-- <script async src="{{ vnn_asset('js/coreui.js') }}"></script> --}}
        {{-- <script async src="{{ vnn_asset('js/overlayscrollbars.min.js') }}"></script> --}}
        <script async src="{{ vnn_asset('js/adminlte_v4.js') }}"></script>
        <script defer src="{{ vnn_asset('js/data-grid.js') }}"></script>
        {{-- <script defer src="{{ vnn_asset('js/test.js') }}"></script> --}}
    </head>
    <body class="sidebar-mini sidebar-expand-lg layout-fixed bg-body-tertiary dark-mode" data-bs-theme="dark">
        @include('admin::partial.loading')

        <div class="fixed-top w-25 mt-3" id="popupToast"></div>

        <section class="app-wrapper" id="pjax-content-container">
            @include('admin::partial.header')

            @include('admin::partial.sidebar')

            @include('admin::partial.content')

            @include('admin::partial.footer')

            @stack('scripts')
            @yield('scripts_content')
        </section>

        @include(modal_view_template())
    </body>
</html>
