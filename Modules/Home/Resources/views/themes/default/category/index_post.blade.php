@php
    $posts = $info->posts;
@endphp
<x-portfolio :cols="[1, 'md-3', 'lg-4']" :gutters="3" :items="Modules\Home\Facades\Portfolio::convert(collect($posts->items()))" />
<div class="mt-3">
{!! $posts->links() !!}
</div>
