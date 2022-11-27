<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 border-bottom border-secondary">
          <div class="col-sm-6">
            @section('content_header')
                <h4 class="d-inline-block border-bottom border-primary m-0 pm-3">@lang($page_title)</h4>
            @show
          </div><!-- /.col -->
          <div class="col-sm-6">
            @include('admin::partial.breadcrumb')
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
