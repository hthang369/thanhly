@extends(module_view('layouts.master'))

@section('content')
    @foreach (data_get($data, 'data.children') as $item)
        <x-card header-class="bg-primary" body-class="px-0">
            @include(module_view_name("category.{$item->category_type}"))
        </x-card>
    @endforeach
@endsection
