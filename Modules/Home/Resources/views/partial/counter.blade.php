<div class="text-white">
<p>@lang('common.counter.title')</p>
<div class="d-flex justify-content-between">
    <span>@lang(module_trans('common.counter.isOnline'))</span>
    <span>{{data_get($visitOnline, 'isOnline')}}</span>
</div>
<div class="d-flex justify-content-between">
    <span>@lang(module_trans('common.counter.todayOnline'))</span>
    <span>{{data_get($visitOnline, 'todayOnline')}}</span>
</div>
<div class="d-flex justify-content-between">
    <span>@lang(module_trans('common.counter.totalOnline'))</span>
    <span>{{data_get($visitOnline, 'totalOnline')}}</span>
</div>
</div>