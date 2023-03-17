@extends(module_view('layouts.master'))

@section('content')
<main id="app">
    <x-section-box id="about" class="about" :title="data_get($data, 'data.post_title')" title-class="container-fluid container-lg">
        <div class="container-fluid container-lg mt-4">
            <p class="h2 text-center">Mua tên miền tốt nhất</p>
            <p class="text-center">Kiểm tra tên miền đăng ký được không ngay bây giờ.</p>

            @php
                $baseUrl = rtrim(route('page.domain-search'), 'domain-search');
            @endphp
            <domain-search base-url="{{$baseUrl}}"></domain-search>

            <div class="text-center">
            {!! data_get($data, 'data.post_content') !!}
            </div>
        </div>
    </x-section-box>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/app_admin.js') }}"></script>
@endpush
