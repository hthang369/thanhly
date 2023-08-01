@extends('admin::layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('setting::configs.web_card_title') }}</h3>
            </div>
            <div class="card-body">
                {!! form($data['form']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('setting::configs.web_card_home') }}</h3>
            </div>
            <div class="card-body">
                {!! form($data['formHome']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('setting::configs.web_card_map') }}</h3>
            </div>
            <div class="card-body">
                {!! form($data['formMap']) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function($) {
        _grids.modal.init({});
    })(jQuery);
</script>
@endpush