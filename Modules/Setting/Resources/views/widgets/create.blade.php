@extends('admin::layouts.master')

@section('content_header')
<div class="d-flex align-items-center">
    <h3 class="mb-0 mr-3 d-inline">Widgets</h3>
    {!! link_to_route('widget.index', 'Back', [], ['class' => 'btn btn-primary btn-sm']) !!}
</div>
@endsection
@section('content')
    <nav class="nav">
        <span class="nav-link">Add widgets</span>
        {!! link_to_route('widget.new', 'Add Widget Group', ['group'], ['class' => 'nav-link']) !!}
    </nav>
    <div class="row">
        <div class="col-4">
        {!! $data['form'] !!}
        </div>
    </div>
@endsection
