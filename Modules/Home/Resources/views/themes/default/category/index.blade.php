@extends(module_view('layouts.master'))

@section('content')
@php
    $info = $data['data'];
@endphp
@includeIf(module_view("category.index_{$info->category_type}"), compact('info'))
@endsection
