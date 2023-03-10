<section class="container-fluid container-lg">
    <x-row>
        <x-col class="mt-2 px-2">
            <x-card bodyClass="p-0">
                @include('home::partial.menuside')
            </x-card>
            <x-card class="mt-2 content" no-body>
                @yield('content')
            </x-card>
        </x-col>
    </x-row>
</section>