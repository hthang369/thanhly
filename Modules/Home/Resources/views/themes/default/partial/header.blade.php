<section class="header-wrapper bg-white">
    <header class="container-fluid container-lg container-xl">
        <div id="iHeader" class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div id="ilogo" class="d-none d-sm-block">
                        <a href="/"><x-image src="{{ image_asset(data_get($infoSettings, 'home.web_logo')) }}" fluid
                                lazyload height="110" /></a>
                    </div>
                    <div class="topmenu">
                        <a href="/"><x-image src="{{ image_asset(data_get($infoSettings, 'home.web_banner')) }}"
                                fluid lazyload height="140" /></a>
                        <x-menu :title="config('laka.page_name')" id="navbarMenu" type="offcanvas"
                            wrapper-class="py-1 justify-content-xl-end">
                            {!! $menus !!}
                        </x-menu>
                    </div>
                </div>
            </div>
        </div>
    </header>
</section>
