@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="about" class="about" :title="data_get($data, 'data.category_name')" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg mt-4">
            <p class="text-center h2 mb-4">Bảng giá hosting</p>
            @php($listProduct = data_get($data, 'data.products'))
            <x-card-group :cols="[1, 'md-3']">
            @foreach (Modules\Home\Facades\Portfolio::convertProduct($listProduct->items()) as $pro)
                <x-card class="card-hosting">
                    <x-slot name="header">
                        <p class="text-center mb-2">{{data_get($pro, 'title')}}</p>
                        <small class="text-center d-block">{{data_get($pro, 'excerpt')}}</small>
                    </x-slot>

                    <p class="text-center">
                        <span class="text-line-through">{{currency_format(data_get($pro, 'price'), 'VND')}}</span>
                        <span class="badge badge-danger">{{data_get($pro, 'promotion_value')}}</span>
                    </p>
                    <p class="text-center hosting-price">
                        <span>{{currency_format(data_get($pro, 'promotion_price'), 'VND')}}</span>
                        <span>/{{data_get($pro, 'uom.uom_name')}}</span>
                    </p>
                    <p class="text-center">
                    <x-button variant="primary" href="tel:0976112209">Liên hệ</x-button>
                    </p>
                    <p>{{data_get($pro, 'promotion_text')}}</p>

                    <div>{!! data_get($pro, 'content') !!}</div>
                </x-card>
            @endforeach
            </x-card-group>
        </div>
    </x-section-box>
</main>
@endsection
