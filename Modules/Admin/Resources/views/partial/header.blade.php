<nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-dark sticky-top">
    <!-- Left navbar links -->
    @include('admin::partial.headers.menu')

    <!-- SEARCH FORM -->
    @include('admin::partial.headers.search')

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      @include('admin::partial.headers.message')
      <!-- Notifications Dropdown Menu -->
      @include('admin::partial.headers.notification')
      <!-- Zoom Menu -->
      @include('admin::partial.headers.zoom')
      <!-- Account info Menu -->
      @include('admin::partial.headers.account-info')
    </ul>
  </nav>
