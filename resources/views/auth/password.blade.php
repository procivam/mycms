<!DOCTYPE html>
<html>
  <head>
    @include('Backend.Parts.Head')
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Enter email for restore password</p>
        <form action="/auth/login" method="post">
          {!! csrf_field() !!}
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">    
              <button type="submit" class="btn btn-primary btn-block btn-flat">Retore password</button>
            </div><!-- /.col -->
          </div>
        </form>
        <a href="{{ url('/auth/login') }}">I already have a membership</a>
        <br>
        <a href="/auth/register" class="text-center">Register a new membership</a>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    @include('Backend.Parts.Scripts')
  </body>
</html>