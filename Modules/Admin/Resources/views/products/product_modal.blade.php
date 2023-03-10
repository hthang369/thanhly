{!! Modal::start($data['modal']) !!}
<x-tabs>
    <x-tab title="Thông tin chính" active>
        {!! $data['form'] !!}
    </x-tab>
    <x-tab title="Thông tin chi tiết">
        cbad
    </x-tab>
</x-tabs>
{!! Modal::end() !!}
<script src="{{ vnn_asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('content'); </script>
@include('ckfinder::setup')

