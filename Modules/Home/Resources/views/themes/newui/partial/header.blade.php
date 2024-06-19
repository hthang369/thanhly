<section class="header-wrapper bg-white">
    <div style="background: #f1f1f1">
        <div class="d-flex justify-content-between container-fluid container-lg container-xl">
            <div></div>
            <div class="py-2">
                <span class="mr-4">
                    <b><i class="bi bi-envelope mr-2"></i>Email: </b>
                    <span>{!! link_to_email(data_get($infoSettings, 'info.web_email'), null, ['class' => 'text-dark']) !!}</span>
                </span>
                <span>
                    <b><i class="bi bi-telephone mr-2"></i>Phone: </b>
                    <span>{!! link_to_tel(data_get($infoSettings, 'info.web_phone'), null, ['class' => 'text-dark']) !!}</span>
                </span>
            </div>
        </div>
    </div>
    <header class="container-fluid container-lg container-xl">
        <div class="row py-2">
            <div class="col-lg-4">
                <div class="row align-items-center h-100">
                    <div class="col">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ data_get($infoSettings, 'info.web_address') }}</span>
                    </div>
                    <div class="col">
                        <i class="bi bi-alarm"></i>
                        <span>Thứ 2 - Chủ nhật 8:00 am - 8:00 pm</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <a href="/">
                    <x-image src="{{ image_asset(data_get($infoSettings, 'home.web_banner')) }}" fluid lazyload height="140" />
                </a>
            </div>
        </div>
    </header>
    <x-menu :title="config('laka.page_name')" id="navbarMenu" type="offcanvas" wrapper-class="navbar-topmenu py-3 justify-content-center sticky-top" class="justify-content-center" theme="dark">
        {!! $menus !!}
    </x-menu>
</section>
