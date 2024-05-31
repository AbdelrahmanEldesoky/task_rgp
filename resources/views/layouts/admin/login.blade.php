<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.include.auth.head')
    @stack('css')
  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signing"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
            @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>
