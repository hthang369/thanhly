<div class="swiper mySwiper">
    <div class="swiper-wrapper">
    @foreach ($listData as $item)
        <div class="swiper-slide">
        <x-card class="col list-article border-0" no-body>
            <x-link :to="['page.show-detail', $item->post_link]">
                <x-image src="{{image_asset($item->post_image)}}" lazyload height="200" class="card-img-top" :alt="$item->post_title" />
            </x-link>
            <div class="card-body">
            <x-link :to="['page.show-detail', $item->post_link]">
                <h5 class="card-title text-truncate">{{$item->post_title}}</h5>
            </x-link>
            </div>
        </x-card>
        </div>
    @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
