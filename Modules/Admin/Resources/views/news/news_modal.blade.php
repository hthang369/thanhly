{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end() !!}
<script src="{{ vnn_asset('ckeditor/ckeditor.js') }}"></script>
<script>
// onDOMContentLoaded(() => {
//     CKEDITOR.replace('post_content');
//     console.log(CKEDITOR)
// })
console.log(CKEDITOR)
</script>
@include('ckfinder::setup')
