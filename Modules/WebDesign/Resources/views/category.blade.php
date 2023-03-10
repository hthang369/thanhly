@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="category" class="category" :title="$data['category_name']" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg">
            @php($post_list = $data['pagination_posts'])
            <x-portfolio :items="Modules\Home\Facades\Portfolio::convert(collect($post_list['data']))" />
            <x-pagination :total="$post_list['total']" :current="$post_list['current_page']" :pages="$post_list['last_page']" />
        </div>
    </x-section-box>
</main>
@endsection
