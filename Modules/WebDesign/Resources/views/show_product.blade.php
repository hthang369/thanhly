@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="about" class="about" :title="$data['name']" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg mt-4">
            <x-button variant="link" :to="['page.preview', $data['link']]">Prview</x-button>    
            
            {!! $data['content'] !!}
        </div>
    </x-section-box>
</main>
@endsection
