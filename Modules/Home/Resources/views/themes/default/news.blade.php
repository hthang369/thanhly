@extends(module_view('layouts.master'))

@section('content')
    <div class="list-unstyled">
        @php
            $post_list = data_get($data, 'data.news');
        @endphp
        @foreach($post_list->items() as $post)
            <x-card no-body class="mb-3 border-0">
                <div class="row g-3">
                    <div class="col-auto">
                        @php($post_image = $post['post_image'])
                        <x-image :src='asset("storage/images/$post_image")' lazyload :alt="$post_image" width="200" class="mr-3" />
                    </div>
                    <div class="col">
                        <h5><a href="{{ route('page.show-news', $post['post_link']) }}">{{ $post['post_title'] }}</a></h5>
                        <p>{{ $post['post_excerpt'] }}</p>
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
    <div class="mt-3">
    {!! $post_list->links() !!}
    </div>
@endsection
