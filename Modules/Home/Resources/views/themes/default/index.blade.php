@extends(module_view('layouts.master'))

@section('content')
    <x-card class="border-0 pt-4">
        {!! data_get($data, 'info.post_content') !!}
    </x-card>
  @foreach ($data['list_categories'] as $item)
    <x-card body-class="p-0 pt-3" class="border-0 pt-4" header-class="header-title">
      <x-slot name="header">
          {!! link_to_route('page.show-service', $item->category_name, $item->category_link, []) !!}
      </x-slot>
      @include(module_view($item->view_name), ['listData' => $item->posts])
    </x-card>
  @endforeach

  {{-- <x-card body-class="p-0 pt-3" class="border-0 pt-4" header-class="header-title">
    <x-slot name="header">
        {!! link_to_route('page.show', 'Sản phẩm', 'san-pham', []) !!}
    </x-slot>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
      @foreach ($data['list_products'] as $product)
        <div class="swiper-slide">
          <x-card no-body class="item-product border-0">
            <x-link :to="['page.show-product', $product->link]">
              <x-image src="{{image_asset($product->image)}}" lazyload height="200" class="card-img-top" alt="{{ $product->name }}" />
            </x-link>
            <div class="card-body">
              <x-link :to="['page.show-product', $product->link]">
                <h5 class="card-title text-truncate">{{$product->name}}</h5>
                <p class="m-0 text-danger">{{currency_format($product['price'], data_get($product, 'currency.currency_no'))}}</p>
              </x-link>
              <p class="card-text">{{$product->excerpt}}</p>
            </div>
          </x-card>
        </div>
      @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
  </x-card> --}}

  <x-card header-class="header-title" class="border-0 pt-4">
    <x-slot name="header">
        <span>Liên hệ</span>
    </x-slot>
    <x-row class="justify-content-center">
        <x-col :cols="[12, 'md-7']" class="home-contact">
            <x-form-base />
        </x-col>
    </x-row>
  </x-card>
@endsection
