<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
  
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/Backend/img/default_user.png" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>{{ $user->name }}</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
    <form action="{{ url('/backend') }}" method="get" class="sidebar-form">
      {!! csrf_field() !!}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="input-group">
        <input type="text" name="query" class="form-control" placeholder="{{ trans('Search') }}..." value="{{ Input::get('query') }}"/>
        <span class="input-group-btn">
          <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">{{ trans('backend.Main navigation') }}</li>
      @foreach ($menu[0] as $item)
        <?php $active = $_SERVER['REQUEST_URI'] == '/backend/'.$item->alias ? 'active' : '' ?>
        <li class="treeview {{ $active }}">
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

  </section>
  <!-- /.sidebar -->
</aside>