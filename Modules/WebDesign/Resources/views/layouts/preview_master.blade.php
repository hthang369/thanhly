<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include(module_view('partial.google'))
        <title>@yield('header_title', $webName)</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset("storage/images/$webFavicon") }}">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/home_design.css') }}" rel="stylesheet">
        @stack('script_gg')
    </head>
    <body>
        @stack('no_script')

        <section class="container-fluid">
            <header id="header" class="d-flex align-items-center bg-white sticky-top">
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="logo">
                        <h1><a href="/"><img src="{{ asset("storage/images/$webLogo") }}" /></a></h1>
                    </div>
                </div>
            </header>

            @yield('content')

        </section>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
