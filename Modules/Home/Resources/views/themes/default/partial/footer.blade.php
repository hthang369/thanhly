<footer class="mt-3 bg-dark">
    <div id="footer">
        <div class="container-fluid container-lg py-4 text-white">
            <x-row class="g-3">
                <x-col>
                    <div class="footer-info">
                        <x-row class="row-cols-1 row-cols-md-3">
                            <x-col>
                                <h5 class="text-uppercase widget-title">{{ data_get($infoSettings, 'info.web_name') }}</h5>
                                <p class="m-0 mb-2">{{ data_get($infoSettings, 'info.web_address') }}</p>
                                <p class="m-0 mb-2">Phone: {!! link_to_tel(data_get($infoSettings, 'info.web_phone'), null, ['class' => 'text-white']) !!}</p>
                                <p class="m-0 mb-2">Email: {!! link_to_email(data_get($infoSettings, 'info.web_email'), null, ['class' => 'text-white']) !!}</p>
                            </x-col>
                            <x-col>
                                @include('home::partial.support')
                            </x-col>
                            <x-col>
                                @include('home::partial.counter')
                            </x-col>
                        </x-row>
                        <x-row>
                            <x-col>
                                <p class="text-center">@lang(module_trans('common.footer.link_web'))</p>
                                <p class="list-web text-center">
                                    <span class="badge"><a href="https://suamaytinhvnn.com/">suamaytinhvnn.com</a></span>
                                    <span class="badge"><a href="https://thumuathanhly.group/">thumuathanhly.group</a></span>
                                    <span class="badge"><a href="https://webdesignvnnit.com/">webdesignvnnit.com</a></span>
                                </p>
                            </x-col>
                        </x-row>
                    </div>
                </x-col>
                <x-col class="col-auto">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FcomputerVNNIT%2F&tabs=timeline&height=220&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=604707156661427" height="220" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </x-col>
            </x-row>
            <x-row>
                <x-col class="text-center">
                    <span class="small">© Copyright 2023. All Rights Reserved. Thiết kế bởi VNNIT COMPUTER.</span>
                </x-col>
            </x-row>
        </div>
    </div>
</footer>
