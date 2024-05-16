@extends(module_view('template.second_layout'))

@section('content_data')
<div class="main-content">
    {!! data_get($data, 'data.post_content') !!}
</div>

@include(module_view('template.related'))
@endsection
