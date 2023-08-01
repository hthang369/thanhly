<x-form-group
    :inline="data_get($options, 'wapper.inline', false)">
    @if ($showLabel)
        {!! Form::label($options['label_for'], $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        <x-row>
            <x-col size="3">
                {!! Form::btSelect($name, data_get($options, 'list_type', []), data_get($options, 'selected'), ['id' => 'tablist', 'role' => 'tablist'], ['data-toogle' => 'tab']) !!}
            </x-col>
            <x-col size="9">
                <div class="tab-content">
                    @foreach (config('admin.partial_type') as $key => $val)
                        <div id="{{$key}}_tab" role="tabpanel" aria-labelledby="{{$key}}_tab" class="tab-pane fade {{ data_get($options, 'type_selected') == $key ? 'show active' : '' }}">
                            @php($model = data_get($options, "models.{$key}"))
                            @if ($model)
                            {!! Form::btSelect($key, resolve($model)->getListOfLink()->toArray(), data_get($options, 'type_selected')) !!}
                            @else
                            {!! Form::btText($key, data_get($options, 'type_selected')) !!}
                            @endif
                        </div>
                    @endforeach
                </div>
            </x-col>
        </x-row>
    @endif
</x-form-group>
<script>
$('#tablist').tab()
</script>