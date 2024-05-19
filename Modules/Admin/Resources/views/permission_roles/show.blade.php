@extends('admin::layouts.master')

@section('content_header')
    <h4 class="d-inline-block border-bottom border-primary m-0 pm-3">
        @lang($page_title):
        {{$data['name']}}
    </h4>
@endsection

@section('content')
    {!! $data['grid'] !!}
@endsection

@push('scripts')
<script defer>
window.addEventListener('DOMContentLoaded', () => {
    PermissionRole.save('#permissionRole-grid input[type=checkbox]', '{{route("role_has_permissions.update", $data["role_id"])}}')
})
// $(document).ready(function() {
//     $('.btn-save').on('click', function(e) {
//         e.preventDefault();
//         let props = [];
//         let values = [];
//         _.forEach($('#permissionRole-grid input[type=checkbox]'), function(item) {
//             props.push($(item).attr('name'));
//             values.push($(item).is(':checked'));
//         });
//         let data = JSON.stringify(_.zipObject(props, values))
//         $api.put('{{route("role_has_permissions.update", $data["role_id"])}}', data, {
//             contentType: 'application/json',
//             'targetLoading': '#btn-save',
//             'pjaxContainer': '#permissionRole-grid'
//         });
//     });
// });
</script>
@endpush
