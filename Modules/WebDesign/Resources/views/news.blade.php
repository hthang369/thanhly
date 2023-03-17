@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    @php($post_list = data_get($data, 'data.news'))
    <x-section-box id="news" class="news" :title="data_get($data, 'data.category_name')" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg">
            <ul class="list-unstyled">
                @foreach($post_list->items() as $post)
                    <x-media tag="li" class="mb-3">
                        <x-slot name="object">
                            @php($post_image = $post['post_image'])
                            <x-image :src='asset("storage/images/$post_image")' :alt="$post_image" width="200" class="mr-3" />
                        </x-slot>

                        <h5><a href="{{ route('page.show-detail', $post['post_link']) }}">{{ $post['post_title'] }}</a></h5>
                        <p>{{ $post['post_excerpt'] }}</p>
                    </x-media>
                @endforeach
            </ul>
            {!! $post_list->links() !!}
        </div>
    </x-section-box>
</main>
@endsection
