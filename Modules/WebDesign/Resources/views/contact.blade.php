@extends(module_view('layouts.master'))

@section('content')
<main id="main">
    <x-section-box id="contact" class="contact" :title="data_get($data, 'data.post_title')">
        <div class="map">
            {!! data_get($infoSettings, 'map.web_map') !!}
        </div>

        <div class="container-fluid container-lg">
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

          <x-form-base />
        </div>
    </x-section-box>
</main>
@endsection
