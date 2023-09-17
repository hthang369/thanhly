@extends('home::layouts.master')

@section('content')
  @foreach ($data['list_categories'] as $item)
    <x-card body-class="p-0 pt-3" class="mb-3" header-class="bg-primary">
      <x-slot name="header">
          {!! link_to_route('page.show-service', $item->category_name, $item->category_link, ['class' => 'text-white']) !!}
      </x-slot>
      @include($item->view_name, ['listData' => $item->posts])
    </x-card>
  @endforeach
  
  <x-card body-class="p-0 pt-3" header-class="bg-primary" class="border-0">
    <x-slot name="header">
        {!! link_to_route('page.show', 'Sản phẩm', 'san-pham', ['class' => 'text-white']) !!}
    </x-slot>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-2">
      @foreach ($data['list_products'] as $product)
        <x-col class="mb-3">
          <x-card no-body class="item-product">
            <x-link :to="['page.show-product', $product->link]">
              <x-image src="{{image_asset($product->image)}}" lazyload height="200" class="card-img-top" alt="..." />
            </x-link>
            <div class="card-body">
              <x-link :to="['page.show-product', $product->link]">
                <h5 class="card-title text-truncate">{{$product->name}}</h5>
                <p class="m-0 text-danger">{{currency_format($product['price'], data_get($product, 'currency.currency_no'))}}</p>
              </x-link>
              <p class="card-text">{{$product->excerpt}}</p>
            </div>
          </x-card>
        </x-col>
      @endforeach
    </div>
  </x-card>
@endsection
