@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="about" class="about" :title="$data['post_title']" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg mt-4">
            @if ($data['post_type'] == 'post')
                <x-button variant="link" :to="['page.preview', $data['post_link']]">Prview</x-button>    
            @endif
            
            {!! $data['post_content'] !!}
        </div>
    </x-section-box>
</main>
@endsection
