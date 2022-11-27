<div class="wather font-weight-bold">
    @php($key = ($data['current']->hour <= 17) ? 'day' : 'night')
    <h4 class="text-center">{{$data['location']}}</h4>
    <p class="text-center m-0">{{data_get($data, 'list_wather.'.$data['current']->englishDayOfWeek.'.date')}}</p>
    <p class="text-center m-0">
        <img class="avatar" src="{{data_get($data, 'list_wather.'.$data['current']->englishDayOfWeek.".precipitation.{$key}.icon")}}" />
        <span>
        {{data_get($data, 'list_wather.'.$data['current']->englishDayOfWeek.'.temperature.min')}} °C
        <span>-</span>
        {{data_get($data, 'list_wather.'.$data['current']->englishDayOfWeek.'.temperature.max')}} °C
        </span>
    </p>
    <p class="text-center m-0">
        {{data_get($data, 'list_wather.'.$data['current']->englishDayOfWeek.".precipitation.{$key}.icon_phrase")}}
    </p>
</div>