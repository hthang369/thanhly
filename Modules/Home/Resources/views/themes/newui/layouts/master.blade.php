<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{-- @include(module_view('home',  'partial.google') --}}
        <title>{{$pageTitle ?: data_get($infoSettings, 'info.web_name')}}</title>
        {{-- @include(module_view('home',  'partial.seo-meta') --}}
        @include(module_view('partial.link'))
        @stack('styles')
        @stack('script_gg')
    </head>
    <body>
        @stack('no_script')

        <section class="wrapper">
            @include(module_view('partial.header'))

            @include(module_view('partial.content'))

            @include(module_view('partial.footer'))
        </section>

        <script src="{{ vnn_asset('js/app.js') }}"></script>
        {{-- <script src="{{ vnn_asset('js/jquery.validate.min.js') }}"></script> --}}
        <script src="{{ vnn_asset('js/main.js') }}"></script>
        @stack('scripts')
    </body>
</html>
