<x-row class="g-2">
    <x-col :md="6" :cols="12">
        @foreach ($listData->take(4) as $item)
            <x-card class="mb-3 list-article border-0" no-body>
                <x-row class="g-0">
                    <x-col cols="4">
                        <x-link :to="['page.show-detail', $item->post_link]">
                            <x-image src="{{image_asset($item->post_image)}}" lazyload class="img-fluid rounded-start" alt="..." />
                        </x-link>
                    </x-col>
                    <x-col cols="8">
                        <div class="card-body pt-0">
                            <x-link :to="['page.show-detail', $item->post_link]">
                                <h5 class="card-title text-truncate">{{$item->post_title}}</h5>
                            </x-link>
                            <p class="card-text text-truncate-3">{{$item->post_excerpt}}</p>
                        </div>
                    </x-col>
                </x-row>
            </x-card>
        @endforeach
    </x-col>
    <x-col :md="6" :cols="12">
        @foreach ($listData->take(4) as $item)
            <x-card class="mb-3 list-article border-0" no-body>
                <x-row class="g-0">
                    <x-col cols="4">
                        <x-link :to="['page.show-detail', $item->post_link]">
                            <x-image src="{{image_asset($item->post_image)}}" lazyload class="img-fluid rounded-start" alt="..." />
                        </x-link>
                    </x-col>
                    <x-col cols="8">
                        <div class="card-body pt-0">
                            <x-link :to="['page.show-detail', $item->post_link]">
                                <h5 class="card-title text-truncate">{{$item->post_title}}</h5>
                            </x-link>
                            <p class="card-text text-truncate-3">{{$item->post_excerpt}}</p>
                        </div>
                    </x-col>
                </x-row>
            </x-card>
        @endforeach
    </x-col>
</x-row>