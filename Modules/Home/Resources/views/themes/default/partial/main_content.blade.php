<section class="main-wrapper container-fluid">
    <x-row class="g-4">
        <x-col cols="12" class="p-0">
            @include(vnnit_module_view('home', 'partial.menuside'))
        </x-col>
        <x-col cols="12">
            <div class="container-fluid container-lg">
                @yield('content')
            </div>
        </x-col>
    </x-row>
</section>
