@extends('admin::layouts.master')

@section('content')
{!! $grid !!}
@endsection

@section('scripts_content')
<script>
    $(document).ready(function() {
        $('#menu_type').change(function(e) {
            location.href = "{{route('menus.index')}}/" + $(this).val();
        });
        $(document).on('change', '#tablist', function(e) {
            $('.tab-pane').removeClass('show active')
            $('#'+$(this).val()+'_tab').addClass('show active')
        });
    });
</script>
@endsection
