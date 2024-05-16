<x-card header-class="header-title" class="border-0" body-class="px-0">
    <x-slot name="header">
        <x-link :to="['page.show-service', $item->category_link]">
            {{$item->category_name}}
        </x-link>
    </x-slot>
    <x-portfolio :cols="[1, 'md-3', 'lg-4']" :gutters="3" :items="Modules\Home\Facades\Portfolio::convert($item->posts)" />
</x-card>
