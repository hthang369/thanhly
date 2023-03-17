@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="product" class="product" :title="data_get($data, 'data.category_name')" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg">
            @foreach(data_get($data, 'data.children') as $item)
            <x-card>
                <x-slot name="header">
                    {!! link_to(route('page.show-post', data_get($item, 'category_link')), data_get($item, 'category_name')) !!}
                </x-slot>
                <x-portfolio :items="Modules\Home\Facades\Portfolio::convertProduct(data_get($item, 'products')->items())" />
            </x-card>
            @endforeach
        </div>
    </x-section-box>
</main>
@endsection
