<x-card :header="$sidebarHeader" header-class="bg-primary" body-class="px-0" class="content">
    <ul class="list-unstyled list-popular">
        @foreach ($listPopular as $item)
        <li class="mb-3">
            <x-card>
                <x-slot name="image">
                    <a class="d-flex" href="{{ $item['link'] }}">
                        <x-image :src="image_asset($item['image'])" lazyload :alt="$item['image']" fluid />
                    </a>
                </x-slot>

                <h5 class="text-truncate"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></h5>
            </x-card>
        </li>
        @endforeach
    </ul>
</x-card>