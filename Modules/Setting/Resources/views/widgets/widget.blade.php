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
<div id="app">
<widget-group base-url="http://thietkewebvnnit.com/api/v1/"></widget-group>
</div>
@endsection

@push('scripts')
<script src="{{ vnn_asset('js/app_admin.js') }}"></script>
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
