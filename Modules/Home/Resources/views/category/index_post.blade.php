@php
    $posts = $info->posts;
@endphp
<x-portfolio :cols="[1, 'md-3', 'lg-4']" :items="Modules\Home\Facades\Portfolio::convert(collect($posts->items()))" />
{!! $posts->links() !!}