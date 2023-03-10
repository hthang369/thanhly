@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="product" class="product" :title="$data['category_name']" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg">
            @foreach($data['children'] as $data)
            <x-card>
                <x-slot name="header">
                    {!! link_to(route('page.show-post', $data['category_link']), $data['category_name']) !!}
                </x-slot>
                <x-portfolio :items="Modules\Home\Facades\Portfolio::convert($data->posts)" />
            </x-card>
            @endforeach
        </div>
    </x-section-box>
</main>
@endsection
