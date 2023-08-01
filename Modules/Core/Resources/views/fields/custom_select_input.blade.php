<x-form-group
    :inline="data_get($options, 'wapper.inline', false)">
    @if ($showLabel)
        {!! Form::label($options['label_for'], $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        @php
            $newName = trim($name, '[]');
            $choises = data_get($options, 'choices', []);
        @endphp
        @foreach ($choises as $idx => $item)
        <x-row>
            <x-col>
                {!! Form::btSelect("{$newName}[{$idx}][id]", $choises, data_get($options, 'selected'), array_except($options['attr'], ['wrapper'])) !!}
            </x-col>
            <x-col>
                {!! Form::btText("{$newName}[{$idx}][qty]", data_get($options, 'value')) !!}
            </x-col>
        </x-row>
        @endforeach
    @endif
</x-form-group>