@extends('home::layouts.master')

@section('content')
<x-row class="g-2">
    <x-col :md="9" class="tab-content">
        @yield('content_data')
    </x-col>
    <x-col :md="3">
        @include(module_view('partial.right'))
    </x-col>
</x-row>
@endsection