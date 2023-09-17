@extends(module_view('template.second_layout'))

@section('content_data')
@php
    $info = $data['data'];
    $product_attributes = $info->product_attributes;
    // dd($info);
@endphp
<x-row class="g-2">
    <x-col cols="5">
        <x-image :src="image_asset(data_get($info, 'image'))" lazyload class="img-fluid" />
    </x-col>
    <x-col>
        <x-row>
            <x-col cols="4">Mã sản phẩm</x-col>
            <x-col cols="8">{{$info['sku']}}</x-col>
        </x-row>
        <x-row class="mb-3">
            <x-col cols="4">Giá</x-col>
            <x-col cols="8">
                <span class="tx-20 text-danger">{{currency_format($info['price'], data_get($info, 'currency.currency_no'))}}</span>
                @if ($info->original_price > 0)
                <span class="text-line-through text-muted">{{currency_format($info['original_price'], data_get($info, 'currency.currency_no'))}}</span>    
                @endif
            </x-col>
        </x-row>
        @if (!blank($item->variant))
        <x-row class="mb-3">
            <x-col>
                <x-button variant="outline-secondary">{{$item->variant->variant_name}}</x-button>
            </x-col>
        </x-row>    
        @endif
        @isset($info->promotion_text)
        <x-row class="mb-3">
            <x-col>
                @foreach ($info->promotion_text as $item)
                    <p class="m-0">{{$item}}</p>
                @endforeach
            </x-col>
        </x-row>    
        @endisset
        
        <x-row class="mb-3">
            <x-col>
                @foreach ($info->standout_attributes as $key => $item)
                    <p class="m-0">
                        <span>@lang(module_trans("common.attrs.{$key}"))</span>
                        <span>{{$item}}</span>
                    </p>
                @endforeach
            </x-col>
        </x-row>
        <x-row class="mb-3">
            <x-col>
                <x-button variant="danger">@lang(module_trans('common.contact'))</x-button>
            </x-col>
        </x-row>
    </x-col>
</x-row>
<x-row class="mt-3">
    <x-col>
        <x-tabs class="tab-content-detail">
            <x-tab :title="module_trans('common.products.content')" active class="p-2">{!! $info['content'] !!}</x-tab>
            <x-tab :title="module_trans('common.products.detail')" class="p-2">
                <x-list-group tag="div" class="attribute-list">
                    @each(module_view('template.detail_attributes'), $product_attributes, 'attrs')
                </x-list-group>
            </x-tab>
        </x-tabs>
    </x-col>
</x-row>
@endsection
