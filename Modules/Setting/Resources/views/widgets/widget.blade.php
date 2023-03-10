@extends('admin::layouts.master')

@section('content_header')
<div class="d-flex align-items-center">
    <h3 class="mb-0 mr-3 d-inline">Widgets</h3>
    @can("add_widget")
        {!! link_to_route('widget.create', 'Add', [], ['class' => 'btn btn-primary btn-sm']) !!}    
    @endcan
</div>
@endsection
@section('content')
@php
    $widgetText = data_get($data, 'data.text');
    $widgetGroup = data_get($data, 'data.group');
    $dataGroup = $widgetText->keyBy('key');
    // dd($data);
@endphp
{{-- <div class="card">
    <h4 class="card-header bg-primary">Preview</h4>
    <div class="card-body px-1">
        @foreach ($widgetGroup as $item)
        <div class="card">
            <h5 class="card-header bg-info">{{$item->header}}</h5>
            <div class="card-body">
                <div class="row">
                @foreach (json_decode($item->value) as $text)
                <div class="col">
                <div class="alert alert-secondary m-0" role="alert">
                    @if ($dataGroup->has($text))
                    {!! $dataGroup->get($text)->text !!}
                    @else
                    {{$text}}
                    @endif
                </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card-footer">
        {!! Form::button('Preview', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
</div> --}}
<x-card-group :cols="[1, 'md-3']">
    @foreach ($widgetText as $header => $item)
    <div class="col">
    <div class="card widgets-group-card">
        <form method="POST" action="{{route('widget.update', $item->key)}}" id="{{$item->key}}">
        <h4 class="card-header">
            <div class="d-flex justify-content-between">
                <span>{{$item->header}}</span>
                <div class="btn-group btn-group-sm" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Group
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-select" href="#" data-key="group">Group</a>
                        @foreach ($widgetGroup as $group)
                        <a class="dropdown-item btn-select {{in_array($item->key, json_decode($group->value, true)) ? 'active' : ''}}" href="#" data-key="{{$group->key}}">{{$group->header}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </h4>
        <div class="card-body card-widgets">
            {!! Form::hidden('widget_group', null, ['class' => 'widget_group']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label($item->key, 'Title', []) !!}
                {!! Form::text('title', $item->title, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label($item->key, 'Text', []) !!}
                {!! Form::textarea('text', $item->text, ['class' => 'form-control', 'rows' => 5]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::btButton('Save', 'primary', ['class' => 'btn-sm btn-save', 'data-loading' => __('admin::common.loading')], 'edit', 'widget') !!}
            {!! Form::btButton('Delete', 'danger', ['class' => 'btn-sm btn-remove', 'data-loading' => __('admin::common.loading')], 'edit', 'widget') !!}
        </div>
        </form>
    </div>
    </div>
    @endforeach
</x-card-group>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        _.forEach($('.dropdown-menu'), function(item) {
            let itemActive = _.head($(item).find('a.active'));
            let itemText = _.isNil(itemActive) ? 'Group' : $(itemActive).text();
            let itemKey = _.isNil(itemActive) ? 'Group' : $(itemActive).data('key');
            $(item).parents('.btn-group').find('button').text(itemText);
            $(item).parents('.widgets-group-card').find('.widget_group').val(itemKey)
        });
        $('.btn-select').click(function(e) {
            e.preventDefault();
            let text = $(this).text()
            let key = $(this).data('key')
            $(this).parents('.card').find('.widget_group').val(key)
            $(this).parents('.btn-group').find('button').text(text)
        });
        $('.btn-save').click(function(e) {
            let form = _.head($(this).parents('form'));
            $api.put($(form).attr('action'), JSON.stringify($(form).serializeObject()), {
                pjaxContainer: '#'+form.id,
                targetLoading: this
            })
        });
        $('.btn-remove').click(function(e) {
            let form = _.head($(this).parents('form'));
            $api.delete($(form).attr('action'), JSON.stringify($(form).serializeObject()), {
                contentType: 'application/json',
                pjaxContainer: '#'+form.id,
                targetLoading: this
            })
        });
        // $('.card-widgets textarea').each(function(item) {
        //     $(item).summernote()
        // });
    });
// tinymce.init({
//     selector:'v',
//     menubar: 'file edit view insert format tools table help',
//   toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
// });
// //
// var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

// tinymce.init({
// //   selector: 'textarea',
//   plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
//   imagetools_cors_hosts: ['picsum.photos'],
//   menubar: 'file edit view insert format tools table',
//   toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
//   toolbar_sticky: true,
// //   autosave_ask_before_unload: true,
//   autosave_interval: '30s',
//   autosave_prefix: '{path}{query}-{id}-',
//   autosave_restore_when_empty: false,
//   autosave_retention: '2m',
//   importcss_append: true,
//   height: 400,
//   image_caption: true,
//   quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
//   noneditable_noneditable_class: 'mceNonEditable',
//   toolbar_mode: 'sliding',
//   contextmenu: 'link image imagetools table',
//   skin: useDarkMode ? 'oxide-dark' : 'oxide',
//   content_css: useDarkMode ? 'dark' : 'default',
//   content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
//  });


</script>
@endpush
