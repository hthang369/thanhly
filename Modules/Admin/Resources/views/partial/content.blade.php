<div class="app-main content-wrapper">
    <div class="app-content-header">
      <div class="container-fluid">
        <div class="row mb-2 border-bottom border-secondary">
          <div class="col-sm-6">
            @section('content_header')
                <h4 class="d-inline-block m-0 pm-3">@lang($page_title)</h4>
            @show
          </div><!-- /.col -->
          <div class="col-sm-6 d-flex justify-content-end">
            @include('admin::partial.breadcrumb')
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="app-content">
        @yield('content')
    </div>
</div>
