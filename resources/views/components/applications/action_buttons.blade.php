@php
    $className = array_css_class(['show_modal_form', 'text-nowrap', 'disabled' => !str_is($data['status'], Modules\KbankApp\Enums\DataReportStatus::AVALIABLE)]);
@endphp
@if (now(CURRENT_TIMEZONE)->isAfter($data['report_monthly_end_time']))
    <span class="text-secondary">@lang('application.payment_expired')</span>
@elseif (!blank($data['report_monthly_start_time']) && !blank($data['report_monthly_end_time'])) 
    <span class="text-success">@icon('fas fa-check') @lang('application.requested')</span>
@else
{!! bt_link_to_route('applications.generate', 
    __('application.fields.need_report_monthly'), 
    'outline-primary', array_merge($data->only(['app_id', 'shop_id']), ['ref' => 'shop-grid']), 
    ['class' => $className]) !!}
@endif
