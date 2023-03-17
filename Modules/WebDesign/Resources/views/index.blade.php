@extends(module_view('layouts.master'))

@section('content')
<section id="hero1">
  
  @include(module_view('partial.menuside'))

  @isset($list_page)
  <div class="container-fluid container-lg mt-4">
    <x-media :body="['class' => 'col-12 col-md-6']" class="row">
      <x-slot name="object">
        <x-link :to="['page.show', $list_page->post_link]" class="col-12 col-md-6">
          <x-image :src="image_asset($list_page->post_image)" class="img-fluid"></x-image>
        </x-link>
      </x-slot>
      <x-link :to="['page.show', $list_page->post_link]"><h2 class="mt-5">{{$list_page->post_title}}</h2></x-link>
      <p class="h5">{{$list_page->post_excerpt}}</p>
    </x-media>
  </div>  
  @endisset

  <div class="mt-4">
    <div class="container-fluid container-lg container-service">
      <h3>{{ $categoryInfo->category_name }}</h3>
      <x-portfolio :cols="[1, 'md-3']" :items="Modules\Home\Facades\Portfolio::convert($categoryInfo->posts->take(3))" />
    </div>
  </div>

  <div class="container-fluid container-lg mt-4">
      <h3>Sản phẩm mẫu</h3>
      <x-portfolio :items="$list_post" />
  </div>
</section>
@endsection
