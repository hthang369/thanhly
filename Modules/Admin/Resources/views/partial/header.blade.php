<nav class="app-header navbar navbar-expand navbar-white navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <!-- Left navbar links -->
        @include('admin::partial.headers.menu')

        <!-- SEARCH FORM -->
        @includeWhen(false, 'admin::partial.headers.search')

        <!-- Right navbar links -->

        <ul class="navbar-nav ms-auto">
        <!-- Messages Dropdown Menu -->
        @includeWhen(false, 'admin::partial.headers.message')
        <!-- Notifications Dropdown Menu -->
        @include('admin::partial.headers.notification')
        <!-- Zoom Menu -->
        @include('admin::partial.headers.zoom')
        <!-- Account info Menu -->
        @include('admin::partial.headers.account-info')
        </ul>
    </div>
  </nav>
