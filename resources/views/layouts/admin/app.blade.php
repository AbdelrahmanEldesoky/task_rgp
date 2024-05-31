<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.include.head')
    @stack('css')
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><i class="fa fa-paw"></i> <span>@lang('site.task')!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('dashboard/logo.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>@lang('site.welcome'),</span>
                <h2>{{auth()->user()->user_name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('admin.include.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('admin.include.menu_footer_buttons')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('admin.include.nav')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            @include('admin.include.footer')
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    @include('admin.include.script')
    @stack('js')


    @stack('scripts')

  </body>
</html>
