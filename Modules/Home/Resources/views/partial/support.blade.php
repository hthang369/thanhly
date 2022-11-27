<x-card :noBody="true" class="mt-2">
    <x-card-header tag="h5" class="bg-primary py-2 text-uppercase">
        {{__('common.sidebar.products')}}
    </x-card-header>
</x-card>

<x-card :noBody="true" class="mt-2">
    <x-card-header tag="h5" class="bg-primary py-2 text-uppercase">
        {{__('common.sidebar.typical_products')}}
    </x-card-header>
</x-card>

<x-card :noBody="true" class="mt-2">
    <x-card-header tag="h5" class="bg-primary py-2 text-uppercase">
        {{__('common.sidebar.support')}}
    </x-card-header>
    <div class="list-group">
        <div class="list-group-item border-0 py-2">
            <a href="http://zalo.me/0989757437" class="zalo">
                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                <span style="color:#F00;">Hotline: 0989757437</span>
                <img class="w-100" src="public/images/iconzalo.jpg" />
            </a>
        </div>
        <div class="list-group-item border-0 py-2">
            <a href="http://zalo.me/0797801790" class="zalo">
                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                <span style="color:#F00;">Hotline: 0797801790</span>
                <img class="w-100" src="public/images/iconzalo.jpg" />
            </a>
        </div>
        <div class="list-group-item border-0 py-2">
            <a href="http://zalo.me/0916444105" class="zalo">
                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                <span style="color:#F00;">Hotline: 0366477747</span>
                <img class="w-100" src="public/images/iconzalo.jpg" />
            </a>
        </div>
    </div>
</x-card>
