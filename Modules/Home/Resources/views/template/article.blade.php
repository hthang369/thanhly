<x-row>
    <x-col>
        @foreach ($listData->take(4) as $item)
            <x-card class="mb-3" no-body>
                <x-row class="g-0">
                    <x-col cols="4">
                        <x-link :to="['page.show-detail', $item->post_link]">
                            <img src="{{image_asset($item->post_image)}}" class="img-fluid rounded-start" alt="...">
                        </x-link>
                    </x-col>
                    <x-col cols="8">
                        <div class="card-body pt-0">
                            <x-link :to="['page.show-detail', $item->post_link]">
                                <h5 class="card-title">{{$item->post_title}}</h5>
                            </x-link>
                            <p class="card-text">{{$item->post_excerpt}}</p>
                        </div>
                    </x-col>
                </x-row>
            </x-card>
        @endforeach
    </x-col>
    <x-col>
        @foreach ($listData->take(4) as $item)
            <x-card class="mb-3" no-body>
                <x-row class="g-0">
                    <x-col cols="4">
                        <x-link :to="['page.show-detail', $item->post_link]">
                            <img src="{{image_asset($item->post_image)}}" class="img-fluid rounded-start" alt="...">
                        </x-link>
                    </x-col>
                    <x-col cols="8">
                        <div class="card-body pt-0">
                            <x-link :to="['page.show-detail', $item->post_link]">
                                <h5 class="card-title">{{$item->post_title}}</h5>
                            </x-link>
                            <p class="card-text">{{$item->post_excerpt}}</p>
                        </div>
                    </x-col>
                </x-row>
            </x-card>
        @endforeach
    </x-col>
</x-row>