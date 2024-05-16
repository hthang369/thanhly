<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!-- Brand Logo -->
  <div class="sidebar-brand">
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{vnn_asset('images/logo/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-80 shadow img-circle elevation-3">
        <span class="brand-text fw-light">AdminLTE 4</span>
    </a>
  </div>

  <!-- Sidebar -->
  <div class="sidebar-wrapper">
    <!-- SidebarSearch Form -->
    <div class="form-inline d-none">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <div class="sidebar-search-results">
        <div class="list-group"><a href="#" class="list-group-item">
            <div class="search-title">
              <b class="text-light"></b>N<b class="text-light"></b>o<b class="text-light"></b> <b class="text-light"></b>e<b class="text-light"></b>l<b class="text-light"></b>e<b class="text-light"></b>m<b class="text-light"></b>e<b class="text-light"></b>n<b class="text-light"></b>t<b class="text-light"></b> <b class="text-light"></b>f<b class="text-light"></b>o<b class="text-light"></b>u<b class="text-light"></b>n<b class="text-light"></b>d<b class="text-light"></b>!<b class="text-light"></b>
            </div>
            <div class="search-path">

            </div>
          </a></div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2 nav-indent" data-pjax>
        {!! $slidebar !!}
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
