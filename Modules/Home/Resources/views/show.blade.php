@extends('home::layouts.master')

@section('header_title')
{{ vnn_data_get($data, 'post_title', 'ob_title') }}
@endsection

@section('content')
<x-card-header>
    {!! $data['post_title'] !!}
</x-card-header>
<div class="card-body">
    {!! $data['post_content'] !!}
</div>
@endsection
