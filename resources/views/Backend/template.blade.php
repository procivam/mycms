<!DOCTYPE html>
<html>
    <head>
    @include('Backend.Parts.Head')
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            
            @include('Backend.Parts.Header')

            <!-- Left side column. contains the logo and sidebar -->
            @widget('Backend.LeftSide')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('h1')
                    </h1>
                    @yield('breadcrumbs', '')
                </section>

                @yield('content')

                
            </div><!-- /.content-wrapper -->

            @include('Backend.Parts.Footer')
            
            <!-- Control Sidebar -->
            @include('Backend.Parts.ControlSidebar')
        </div><!-- ./wrapper -->
            
        @include('Backend.Parts.Scripts')

    </body>
</html> 
