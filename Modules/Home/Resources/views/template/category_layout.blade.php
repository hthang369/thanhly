@extends('home::layouts.master')

@section('content')
<x-row class="g-2">
    <x-col cols="9" class="tab-content">
        @yield('content_data')
    </x-col>
    <x-col cols="3">
        @include(module_view('partial.right'))
    </x-col>
</x-row>
@endsection