<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="/Backend/img/default_user.png" class="user-image" alt="{{ $user->name }}"/>
    <span class="hidden-xs">{{ $user->name }}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="/Backend/img/default_user.png" class="img-circle" alt="{{ $user->name }}" />
      <p>
        {{ $user->name }}
        <small>Создано {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</small>
      </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
      <div class="col-xs-4 text-center">
        <a href="#">Followers</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Sales</a>
      </div>
      <div class="col-xs-4 text-center">
        <a href="#">Friends</a>
      </div>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="#" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="{{ url('auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
      </div>
    </li>
  </ul>
</li>