@isset($attrs)
    <x-list-group-item tag="div" class="attribute-item">
        <p>@lang(optional($attrs->first())->group_language)</p>
        <x-list-group tag="div" class="attribute-group-detail">
            @each(module_view('template.detail_attributes'), $attrs, 'attr')
        </x-list-group>
    </x-list-group-item>
@else
    <x-list-group-item tag="div" class="attribute-item-detail">
        <span class="detail-left">@lang($attr->language)</span>
        <span class="detail-right">{{$attr->value}}</span>
    </x-list-group-item>
@endisset