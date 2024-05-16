<hr class="related-border" />
<div class="related-posts">
    <h5 class="sub-title mb-4"><span>{{ $relatedTitle }}</span></h5>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($listRelated as $item)
                <div class="swiper-slide">
                    <x-card no-body class="item-product border-0">
                        <x-link :href="$item->link">
                          <x-image src="{{image_asset($item->image)}}" lazyload height="200" class="card-img-top" alt="{{ $item->title }}" />
                        </x-link>
                        <div class="card-body">
                          <x-link :href="$item->link">
                            <h5 class="card-title text-truncate">{{$item->title}}</h5>
                            {{-- <p class="m-0 text-danger">{{currency_format($product['price'], data_get($product, 'currency.currency_no'))}}</p> --}}
                          </x-link>
                          <p class="card-text text-truncate-3">{{$item->excerpt}}</p>
                        </div>
                    </x-card>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
