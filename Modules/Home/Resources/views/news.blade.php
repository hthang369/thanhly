@extends('home::layouts.master')

@section('header_title')
{{ vnn_data_get($data, 'menu_title', 'menu_name') }}
@endsection

@section('content')
<x-card-header>
    {!! $data['menu_name'] !!}
</x-card-header>
<div class="card-body">
    Đang cập nhật
</div>
@endsection
