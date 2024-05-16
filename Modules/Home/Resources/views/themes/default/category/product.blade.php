@if ($item->products->count() > 0)
<x-card header-class="header-title" class="border-0" body-class="px-0">
    <x-slot name="header">
        <x-link :to="['page.show-category', $item->category_link]">
            {{$item->category_name}}
        </x-link>
    </x-slot>
    <x-portfolio-products :cols="[1, 'md-3', 'lg-4']" :gutters="3" :items="Modules\Home\Facades\Portfolio::convertProduct($item->products)" />
</x-card>
@endif
