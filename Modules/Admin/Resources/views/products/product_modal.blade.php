{!! Modal::start($data['modal']) !!}
<x-tabs>
    <x-tab title="Thông tin chính" active>
        {!! $data['form'][0] !!}
    </x-tab>
    <x-tab title="Thông tin chi tiết">
        {!! $data['form'][1] !!}
    </x-tab>
    <x-tab title="Thông tin khác">
        {!! $data['form'][2] !!}
    </x-tab>
</x-tabs>
{!! Modal::end() !!}
<script src="{{ vnn_asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('content'); </script>
@include('ckfinder::setup')

