{{-- <x-card :header="$header" no-body header-class="bg-primary">
    <x-portfolio :cols="1" :items="$listData" />
    {!! $slidebar !!}
</x-card> --}}

@includeWhen(true, module_view('template.popular'))