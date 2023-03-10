{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end() !!}
<script src="{{ vnn_asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('post_content'); </script>
@include('ckfinder::setup')

