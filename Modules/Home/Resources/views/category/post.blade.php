<x-slot name="header">
    <x-link :to="['page.show-service', $item->category_link]">
        {{$item->category_name}}
    </x-link>
</x-slot>
<x-portfolio :cols="[1, 'md-3', 'lg-4']" :items="Modules\Home\Facades\Portfolio::convert($item->posts)" />