@extends('admin::layouts.master')

@section('content')
<div class="d-flex justify-content-between">
    <h4>@lang('admin::menus.menu_struct')</h4>
    <x-button id="btn-save-menu" variant="primary" :data-loading="__('admin::common.loading')">@lang('admin::common.btn_save')</x-button>
</div>
<select class="form-multi-select" id="ms1" multiple>
    <option value="0">Angular</option>
    <option value="1">Bootstrap</option>
    <option value="2">React.js</option>
    <option value="3">Vue.js</option>
    <optgroup label="backend">
      <option value="4">Django</option>
      <option value="5">Laravel</option>
      <option value="6">Node.js</option>
    </optgroup>
  </select>
<div class="menu-struct row">
    <div class="col-6">
        {!! $data !!}
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ vnn_asset('js/coreui.js') }}"></script>
{{-- <script src="{{ vnn_asset('js/jquery-ui-sortable.min.js') }}"></script> --}}
<script src="{{ vnn_asset('js/jquery.nestedSortable.js') }}"></script>
<script>
    $(document).ready(function() {
        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            items: 'li',
            handle: 'span',
            placeholder: 'highlight',
            maxLevels: 3,
            opacity: .6,
        });

        $('#btn-save-menu').click(function() {
            let data = JSON.stringify($('ol.sortable').nestedSortable('toArray', {startDepthCount: 0}))
            $api.put('{{route("attributes.update-sort")}}', data, {
                'targetLoading': '#btn-save-menu',
                'pjaxContainer': '.ui-sortable'
            });
        });
    });
</script>
@endpush
