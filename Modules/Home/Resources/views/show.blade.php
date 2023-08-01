@extends(module_view('template.second_layout'))

@section('content_data')
    {!! data_get($data, 'data.post_content') !!}
@endsection
