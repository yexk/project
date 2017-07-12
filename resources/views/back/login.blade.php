<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- END META -->
    <!-- BEGIN SHORTCUT ICON -->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- END SHORTCUT ICON -->
    <title>
      登陆 - Yexk
    </title>
    <!-- BEGIN STYLESHEET-->
    <base href="back/">
		<link href="css/bootstrap.min.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="css/bootstrap-reset.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"><!-- FONT AWESOME ICON CSS -->
		<link href="css/style.css" rel="stylesheet"><!-- THEME BASIC CSS -->
		<link href="css/style-responsive.css" rel="stylesheet"><!-- THEME RESPONSIVE CSS -->
    <!--[if lt IE 9]>
<script src="js/html5shiv.js">
</script>
<script src="js/respond.min.js">
</script>
<![endif]-->
     <!-- END STYLESHEET-->
  </head>
  <body class="login-screen">
    <!-- BEGIN SECTION -->
    <div class="container">
      <form class="form-signin" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">
          Yexk-blog 后台管理
        </h2>
		<!-- LOGIN WRAPPER  -->
        <div class="login-wrap">
          <input name="username" type="text" class="form-control" placeholder="用户名" autofocus>
          <input name="password" type="password" class="form-control" placeholder="密码">
          <label class="checkbox">
            <input type="checkbox" name="remember" value="remember">
            记住密码
            <span class="pull-right">
              <a data-toggle="modal" href="#myModal">
                忘记密码
              </a>
            </span>
          </label>
          <button class="btn btn-lg btn-login btn-block" type="submit">
            登陆
          </button>
          <p>
            or you can sign in via social network
          </p>
          <div class="login-social-link">
            <a href="index.html" class="facebook">
              <i class="fa fa-facebook">
              </i>
              Facebook
            </a>
            <a href="index.html" class="twitter">
              <i class="fa fa-twitter">
              </i>
              Twitter
            </a>
          </div>
        </div>
		<!-- END LOGIN WRAPPER -->
		<!-- MODAL -->
        <div  id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  &times;
                </button>
                <h4 class="modal-title">
                  忘记密码？
                </h4>
              </div>
              <div class="modal-body">
                <p>
                  请输入你的邮箱地址，通过邮箱验证重置密码。
                </p>
                <input type="text" name="email" placeholder="找回账号绑定的邮箱" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">
                  取消
                </button>
                <button class="btn btn-success" type="button">
                  找回密码
                </button>
              </div>
            </div>
          </div>
        </div>
		<!-- END MODAL -->
      </form>
    </div>
    <!-- END SECTION -->
    <!-- BEGIN JS -->
    <script src="js/jquery.js" ></script><!-- BASIC JQUERY LIB. JS -->
	<script src="js/bootstrap.min.js" ></script><!-- BOOTSTRAP JS -->
    <!-- END JS -->
  </body>
</html>

