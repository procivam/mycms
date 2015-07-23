<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    @if ( ($count = 0) > 0 )
      <span class="label label-warning">{{ $count }}</span>
    @endif
  </a>
  <ul class="dropdown-menu">
    <li class="header">{{ trans_choice('backend.New notifications', $count, ['count' => $count]) }}</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <li>
          <a href="#">
            <i class="fa fa-users text-aqua"></i> 5 new members joined today
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-users text-red"></i> 5 new members joined
          </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-user text-red"></i> You changed your username
          </a>
        </li>
      </ul>
    </li>
    <li class="footer"><a href="#">{{ trans('View all') }}</a></li>
  </ul>
</li>