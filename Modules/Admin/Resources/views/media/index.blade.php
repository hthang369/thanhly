@extends('admin::layouts.master')

@section('content')
<div class="file-manager" id="app">
    @include('laka::filemanager.index')
    {{-- <media></media> --}}
</div>
@endsection

@push('scripts')
{{-- <script defer src="{{ vnn_asset('js/main_vue.js') }}"></script> --}}
@endpush
