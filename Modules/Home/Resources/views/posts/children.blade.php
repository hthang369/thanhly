@extends(module_view('template.category_layout'))

@section('content_data')
<x-row>
    {{-- @dd($data) --}}
    <x-col cols="4">
        <x-image :src="image_asset(head($data['images'])['product_image'])" class="img-fluid" />
    </x-col>
    <x-col>
        <x-row>
            <x-col cols="12"><h4>{{$data['name']}}</h4></x-col>
            <x-col cols="4">ma sp</x-col>
            <x-col cols="8">{{$data['sku']}}</x-col>
            <x-col cols="4">gia</x-col>
            <x-col cols="8">{{$data['price']}}</x-col>
        </x-row>
    </x-col>
</x-row>
<x-row class="mt-3">
    <x-col>
        <x-tabs class="tab-content">
            <x-tab title="Thong tin chi tiet" active>{!! $data['content'] !!}</x-tab>
        </x-tabs>
    </x-col>
</x-row>
@endsection
