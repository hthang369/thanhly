<section class="container-fluid container-lg">
    <x-row class="g-2">
        <x-col class="mt-2">
            <x-card bodyClass="p-0">
                @include('home::partial.menuside')
            </x-card>
            <x-card class="mt-2 content border-0" no-body>
                @yield('content')
            </x-card>
        </x-col>
    </x-row>
</section>