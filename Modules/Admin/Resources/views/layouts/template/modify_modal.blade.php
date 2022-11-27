{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end() !!}

@stack('styles')
@stack('scripts')