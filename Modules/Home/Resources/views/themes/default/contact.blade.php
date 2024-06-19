@extends(module_view('layouts.master'))

@section('header_title')
{{ vnn_data_get($data, 'menu_title', 'menu_name') }}
@endsection

@section('content')
<x-card-header>
    {!! $data['menu_name'] !!}
</x-card-header>
<div class="card-body contact p-0">
    <div class="info-wrap mt-5">
        <div class="row">
          <div class="col-lg-4 info">
            @icon('fa fa-map-marker')
            <h4>Location:</h4>
            <p>{{ data_get($infoSettings, 'info.web_address') }}</p>
          </div>

          <div class="col-lg-4 info mt-4 mt-lg-0">
            @icon('fa fa-envelope-o')
            <h4>Email:</h4>
            <p>{{ data_get($infoSettings, 'info.web_email') }}</p>
          </div>

          <div class="col-lg-4 info mt-4 mt-lg-0">
            @icon('fa fa-phone')
            <h4>Call:</h4>
            <p>{{ data_get($infoSettings, 'info.web_phone') }}</p>
          </div>
        </div>
    </div>

    <x-row>
        <x-col :cols="[12, 'md-6']">
            <x-form-base />
        </x-col>
        <x-col :cols="[12, 'md-6']">{!! data_get($infoSettings, 'map.web_map') !!}</x-col>
    </x-row>
</div>
@endsection
