<section class="d-block container-fluid container-lg">
    <div class="row">
        @include('home::partial.left')

        <div id="iContent" class="col-md-9 col-sm-9 col-12 mt-2 ps-1">
            <x-card bodyClass="p-0">
                @include('home::partial.menuside')
            </x-card>
            <div class="card mt-2">
                @yield('content')
            </div>
        </div>
    </div>
</section>