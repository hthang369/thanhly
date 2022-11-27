<x-form-group :class="data_get($options, 'wrapper.class')"
    :inline="data_get($options, 'wrapper.inline', false)">
    @if ($showLabel)
        {!! Form::label(data_get($options, 'label.for', ''), $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        @if($layout == 'grid')
            <div class="{{array_css_class(data_get($options, 'attr.wrapper'))}}">
        @endif
            {!! Html::tag('div', '', array_merge(array_except($options['attr'], ['wrapper', 'class']), ['name' => $name])) !!}

            @includeWhen($showError, laka_component('form-field.errors'))
        @if($layout == 'grid')
            </div>
        @endif
    @endif
</x-form-group>
{{-- <script src="{{ asset('js/dx.web.js') }}"></script> --}}
<script>
    $('div[name="{{$name}}"]').dxDateBox({
        type: 'date',
        openOnFieldClick: true,
        name: '{{$name}}',
        inputAttr: @json(array_only($options['attr'], 'class')),
        displayFormat: "{{data_get($options, 'dateFormat')}}",
        calendarOptions: {
            maxZoomLevel: "{{data_get($options, 'viewMode')}}"
        },
        value: "{{ Carbon\Carbon::parse($options['value'])->toString() }}"
    })
</script>

{{-- @once --}}
@push('styles')
    
@endpush
@push('scripts')

@endpush
{{-- @endonce --}}