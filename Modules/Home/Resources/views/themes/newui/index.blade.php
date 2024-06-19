@extends(module_view('layouts.master'))

@section('content')
<x-card class="border-0 pt-4">
    {!! data_get($data, 'info.post_content') !!}
</x-card>
@foreach ($data['list_categories'] as $item)
<x-card :header="$item->category_name" body-class="p-0 pt-3" class="border-0 pt-4" header-class="header-title">
  {{-- <x-slot name="header">
      {!! link_to_route('page.show-service', $item->category_name, $item->category_link, []) !!}
  </x-slot> --}}
  @include(module_view($item->view_name), ['listData' => $item->posts])

  <x-button>Xem thêm</x-button>
</x-card>
@endforeach

<x-card header="Quy Trình Làm Việc" body-class="p-0 pt-3" class="border-0 pt-4" header-class="header-title">
    <x-row class="widget-box gap-10">
        <x-col class="text-center widget-item">
            <p>01</p>
            <p>TIẾP NHẬN YÊU CẦU</p>
            <div></div>
        </x-col>
        <x-col class="text-center widget-item">
            <p>02</p>
            <p>CHUYỂN THÔNG TIN ĐẾN KỸ THUẬT VIÊN</p>
            <div></div>
        </x-col>
        <x-col class="text-center widget-item">
            <p>03</p>
            <p>TIẾN HÀNH SỬA CHỮA VÀ CHẠY THỬ</p>
            <div></div>
        </x-col>
        <x-col class="text-center widget-item">
            <p>04</p>
            <p>THANH TOÁN DỊCH VỤ</p>
            <div></div>
        </x-col>
    </x-row>
</x-card>

<x-card header="Tin Tức Mới Nhất" body-class="p-0 pt-3" class="border-0 pt-4" header-class="header-title">
</x-card>
@endsection
