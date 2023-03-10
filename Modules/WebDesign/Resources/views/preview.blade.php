@extends(module_view('layouts.preview_master'))

@section('content')
<div class="embed-responsive embed-responsive-16by9">
<iframe src="{{asset('storage/files/'.$data.'/index.html')}}" class="embed-responsive-item" allowfullscreen />
</div>
@endsection