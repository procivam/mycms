<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">{{ trans('backend.Main navigation') }}</li>
  @foreach ($menu[0] as $item)
    <li class="treeview">
      <a href="{{ url('/backend/' . $item->alias) }}">
        @if ($item->icon)
          <i class="fa {{ $item->icon }}"></i>
        @endif
        <span>{{ $item->name }}</span>
        @if(isset($menu[$item->id]))
          <i class="fa fa-angle-left pull-right"></i>
        @endif
      </a>
        @if(isset($menu[$item->id]))
          {!! view('Backend.Widgets.menu_childs', ['menu' => $menu, 'parent_id' => $item->id]) !!}
        @endif
    </li>
  @endforeach