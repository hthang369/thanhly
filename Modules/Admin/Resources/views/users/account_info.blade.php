@extends('admin::layouts.master')

@section('content')
<x-card header="{{__('admin::users.account-info')}}" :dark-mode="true">
    <x-row>
        <x-col size="7" id="account-info">
            {!! $data['accountInfo'] !!}
        </x-col>
    </x-row>
</x-card>

<x-card header="{{__('admin::users.change-pass')}}" :dark-mode="true">
    <x-row>
        <x-col size="6" id="change-password">
            {!! $data['changePassword'] !!}
        </x-col>
    </x-row>
</x-card>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#btn-change').click(function() {
            let data = JSON.stringify($(this).parents('form').serializeObject());
            $api.put("{{route('users.update-pass', user_get('id'))}}", data, {
                'targetLoading': '#btn-change',
                'pjaxContainer': '#account-info'
            });
        });
        $('#btn-account').click(function() {
            let data = JSON.stringify($(this).parents('form').serializeObject());
            $api.put("{{route('users.update-account', user_get('id'))}}", data, {
                'targetLoading': '#btn-account',
                'pjaxContainer': '#change-password'
            });
        });
    })
</script>
@endpush
