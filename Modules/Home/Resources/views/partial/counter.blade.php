<x-card :noBody="true" class="mt-2">
    <x-card-header tag="h5" class="bg-primary py-2 text-uppercase">
        {{__('common.counter.title')}}
    </x-card-header>
    <div class="list-group">
        <div class="list-group-item border-0 py-2">
            <span>{{__('common.counter.isOnline')}}:</span>
            <span>{{data_get($visitOnline, 'isOnline')}}</span>
        </div>
        <div class="list-group-item border-0 py-2">
            <span>{{__('common.counter.todayOnline')}}:</span>
            <span>{{data_get($visitOnline, 'todayOnline')}}</span>
        </div>
        <div class="list-group-item border-0 py-2">
            <span>{{__('common.counter.totalOnline')}}:</span>
            <span>{{data_get($visitOnline, 'totalOnline')}}</span>
        </div>
    </div>
</x-card>
