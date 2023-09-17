@php
    $products = $info->products;
    $parentLink = route('page.show-category', $info->category_link);
@endphp
@if ($info->brands->count() > 1)
<x-list-group horizontal class="mb-3">
    @foreach ($info->brands as $item)
        <x-list-group-item class="p-0">
            <x-link :to="['page.show-brand', ['title' => $info->category_link, 'brand' => $item->brand_link]]">
                <x-image :src="image_asset('brands'.DIRECTORY_SEPARATOR.data_get($item, 'brand_image'))" lazyload />
            </x-link>
        </x-list-group-item>
    @endforeach
</x-list-group>
@else
<span>@lang(module_trans('common.filter_brand'))</span>
<x-alert type="secondary" id="myTag" :message="optional($info->brands->first())->brand_name" dismissible />
@endif
<x-portfolio-products :cols="[1, 'md-3', 'lg-4']" :items="Modules\Home\Facades\Portfolio::convertProduct(collect($products->items()))" />    
{!! $products->links() !!}
@push('scripts')
<script>
$(document).ready(function() {
    $('#myTag').on('close.bs.alert', function() {
        document.location = '{{ $parentLink }}'
    });
});
</script>
@endpush