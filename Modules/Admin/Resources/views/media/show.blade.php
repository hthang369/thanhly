<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', '@Master Layout'))</title>

        <link rel="stylesheet" href="{{ vnn_asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ vnn_asset('css/media.css') }}">
        @stack('styles')
        <script async src="{{ vnn_asset('js/app.js') }}"></script>
        <script defer src="{{ vnn_asset('js/admin.js') }}"></script>
    </head>
    <body class="dark-mode" data-bs-theme="dark">
        <section class="wrapper d-flex">
            <div class="sidebar sidebar-fixed">Sidebar</div>
            <div class="main flex-grow-1">
                <div class="header">
                    <ul class="header-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="bi bi-upload"></i>
                                Upload
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="bi bi-folder-fill"></i>
                                New folder
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="bi bi-grid-fill"></i>
                                Thumbnails
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="bi bi-list-ul"></i>
                                List
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="bi bi-sort-up-alt"></i>
                                Sort
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="container">Main</div>
            </div>
        </section>
        {{-- <ul class="list-group">
            @foreach ($data as $item)
            <li class="list-group-item">
                <div class="form-check d-flex align-items-center">
                    <input class="form-check-input" type="radio" name="radioFile" data-path="{{ url($item['path']) }}" id="{{ $item['file_name'] }}">
                    <label class="form-check-label ml-2" for="{{ $item['file_name'] }}">
                        <img src="{{ url($item['path']) }}" class="img-thumbnail" width="90" alt="...">
                        <span class="ml-2">{{ $item['file_name'] }}</span>
                    </label>
                </div>
            </li>
            @endforeach
        </ul> --}}

        <script defer src="{{ vnn_asset('js/media.js') }}"></script>
    </body>
</html>
