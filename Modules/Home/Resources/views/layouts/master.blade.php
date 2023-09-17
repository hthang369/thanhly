<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{-- @include('home::partial.google') --}}
        <title>{{$pageTitle ?: data_get($infoSettings, 'info.web_name')}}</title>
        @include('home::partial.seo-meta')
        @include('home::partial.link')
        @stack('styles')
        @stack('script_gg')
    </head>
    <body>
        @stack('no_script')

        <section>
            @include('home::partial.header')

            @include('home::partial.content')

            @include('home::partial.footer')

            @include('home::partial.back_to_top')
        </section>

        <script src="{{ vnn_asset('js/app.js') }}"></script>
        <script src="{{ vnn_asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ vnn_asset('js/main.js') }}"></script>
        @stack('scripts')
    </body>
</html>
