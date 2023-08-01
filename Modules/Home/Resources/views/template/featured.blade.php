@php
    $firstData = $listData->first();
@endphp
<x-row class="g-2 list-featured">
    <x-col :md="7" :lg="8">
        <x-card no-body class="featured-hot border-0">
            <x-link :to="['page.show-detail', optional($firstData)->post_link]">
                <img src="{{image_asset(optional($firstData)->post_image)}}" class="card-img img-fluid" alt="...">
            </x-link>
            <div class="card-body">
                <x-link :to="['page.show-detail', optional($firstData)->post_link]">
                    <h5 class="card-title">{{optional($firstData)->post_title}}</h5>
                </x-link>
                <p class="card-text">{{optional($firstData)->post_excerpt}}</p>
            </div>
        </x-card>
    </x-col> 
    <x-col :md="5" :lg="4">
@foreach ($listData->skip(1)->take(4) as $item)
    <x-card no-body class="mb-3 featured-item border-0">
        <x-row class="g-2">
            <x-col cols="4">
                <x-link :to="['page.show-detail', $item->post_link]">
                    <img src="{{image_asset($item->post_image)}}" class="card-img img-fluid" alt="...">
                </x-link>
            </x-col>
            <x-col cols="8">
                <div class="card-body p-0">
                    <x-link :to="['page.show-detail', $item->post_link]">
                        <h5 class="card-title text-truncate">{{$item->post_title}}</h5>
                    </x-link>
                    <p class="card-text text-truncate-3 mb-2">{{$item->post_excerpt}}</p>
                </div>
            </x-col>
        </x-row>
    </x-card>
@endforeach
    </x-col>
</x-row>