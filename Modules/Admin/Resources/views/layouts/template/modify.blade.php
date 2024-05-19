@extends('admin::layouts.master')

@section('content_header')
<h4 class="d-inline-block m-0 pm-3">{{ data_get($data, 'modal.title') }}</h4>
@endsection
@section('content')
<div id="page_modify">
{!! Form::open(modal_form_attrs($data['modal'])) !!}
<div class="d-flex mb-2">
    {!! bt_link_to_route("{$sectionCode}.index", module_trans('common.back'), 'danger', [], ['icon' => 'fa-times', 'class' => 'btn-sm mr-2']) !!}
    <x-button type="submit" variant="success" :text="translate('table.save')" size="sm" icon="fa fa-save" />
</div>
    {!! $data['form'] !!}

{!! Form::close() !!}
</div>
@endsection

@push('scripts')
<script defer>
window.addEventListener('DOMContentLoaded', function() {
    DataModal.submit('#page_modify', 'textarea[name="post_content"]', "{{ route('page.upload-file', null, false) }}")
});
</script>
@endpush
