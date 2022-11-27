<li class="nav-item dropdown pr-4">
    <a class="nav-link position-relative" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="width: 35px;height: 35px;">
      <img class="img-avatar img-circle position-absolute" src="{{ avatar_url(user_get()) }}" alt="{{ user_get('name') }}" onerror="this.style.display='none'" style="margin: 0;position: absolute;left: 0; top:0; z-index: 1;">
      <span class="img-circle text-light d-flex align-items-center justify-content-center position-absolute" style="top:0; left:0; width:35px; background-color: #00a65a; height: 35px;">
        {{user_get('name') ? mb_substr(user_get('name'), 0, 1, 'UTF-8') : 'A'}}
      </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right mr-4 pb-1 pt-1">
      <a class="dropdown-item" href="{{ route('users.account-info') }}"><i class="fa fa-user-o mr-1"></i> {{ trans('admin::common.my_account') }}</a>
      <div class="dropdown-divider"></div>
      <div class="my_account">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="fa fa-sign-out mr-1"></i>
                <span>@lang('admin::common.logout')</span>
            </button>
        </form>
      </div>
    </div>
</li>

