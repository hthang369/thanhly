{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end() !!}
<script src="{{ vnn_asset('public/ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('post_content'); </script>
@include('ckfinder::setup')

