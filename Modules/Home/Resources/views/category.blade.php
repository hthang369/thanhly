@extends(module_view('template.category_layout'))

@section('content_data')
    @foreach ($data['children'] as $item)
        <x-card header-class="bg-primary" body-class="px-0">
            <x-slot name="header">
                @php
                    $route = str_is($item->category_type, Modules\Admin\Enums\CategoryType::PRODUCT) ? 'page.show-product' : 'page.show-service';
                @endphp
                <x-link :to="[$route, $item->category_link]">
                    {{$item->category_name}}
                </x-link>
            </x-slot>
            @if (str_is($item->category_type, Modules\Admin\Enums\CategoryType::PRODUCT))
                <x-portfolio-products :cols="[1, 'md-3']" :items="Modules\Home\Facades\Portfolio::convertProduct($item->products->take(6))" />
            @else
                <x-portfolio :cols="[1, 'md-3']" :items="Modules\Home\Facades\Portfolio::convert($item->posts->take(6))" />
            @endif
        </x-card>
    @endforeach
@endsection
