<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('backend/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>CMS</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>My</b>CMS</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">{{ trans('backend.Toggle navigation') }}</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        @widget('Backend.NewMessages')

        @widget('Backend.NewNotification')

        @widget('Backend.HeaderTasks')

        @widget('Backend.UserAccount')
      
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>