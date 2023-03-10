<x-card :header="module_trans('common.slidebar_right.popular_header')" class="mt-3" header-class="bg-primary" body-class="px-0">
    <ul class="list-unstyled">
        @foreach ($listPopular as $item)
        <li class="mb-3">
            <x-card>
                <x-slot name="image">
                    <x-image :src="image_asset($item['image'])" :alt="$item['image']" width="200" />
                </x-slot>

                <h5><a href="{{ route('page.show-detail', $item['link']) }}">{{ $item['title'] }}</a></h5>
            </x-card>
        </li>
        @endforeach
    </ul>
</x-card>