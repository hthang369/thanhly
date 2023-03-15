@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="about" class="about" :title="$data['post_title']" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg mt-4">
            {!! $data['post_content'] !!}
        </div>
    </x-section-box>
</main>
@endsection
