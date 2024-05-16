@extends(module_view('layouts.master'))

@section('content')
<x-row>
    <div class="col-12 tab-content">
        @yield('content_data')
    </div>
</x-row>
@endsection
