@extends('home::layouts.master')

@section('content')
<main id="main">
    <x-section-box id="category" class="category" title="">
        <p class="">Thương hiệu</p>
        @foreach ($data['results']->brands as $brand)
            <span class="btn border">{{$brand->brand_name}}</span>
        @endforeach
        <x-card class="my-5">
            <x-portfolio-products :items="$data['results']->product_list"></x-portfolio-products>
        </x-card>
    </x-section-box>
</main>
@endsection
