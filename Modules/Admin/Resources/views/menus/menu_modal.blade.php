{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end() !!}

{{-- @section('scripts_content') --}}
<script>
$(document).ready(function() {
    $('#tablist').change(function(e) {
        $('.tab-pane').removeClass('show').removeClass('active');
        $('#link_'+$(this).val()).tab('show')
    });
});
</script>
{{-- @endsection --}}
