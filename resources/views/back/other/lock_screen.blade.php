<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- BEGIN META -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- END META -->
    
    <!-- BEGIN SHORTCUT ICON -->
    <!-- END SHORTCUT ICON -->
    <title>
      锁定
    </title>
    
    <base href="/back/">
    <link rel="shortcut· icon" href="/favicon.ico">
    <!-- BEGIN STYLESHEET-->
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
  <body class="lock-screen" onload="startTime()">
   <!-- LOCK SCREEN WRAPPER-->
    <div class="lock-wrapper">
      <div id="time">
      </div>
      <div class="lock-box text-center">
        <img src="img/follower-avatar.jpg" alt="lock avatar">
        <h1>
            {{ session('YEXK_USERINFO') ? json_decode(session('YEXK_USERINFO'))->name : '' }}
        </h1>
        <span class="locked">
          Locked
        </span>
        <form role="form" class="form-inline" action="index.html">
          <div class="form-group col-lg-12">
            <input type="password" placeholder="Enter Password" id="exampleInputPassword2" class="form-control lock-input">
            <button class="btn btn-lock" type="submit">
              <i class="fa fa-arrow-right">
              </i>
            </button>
          </div>
        </form>
      </div>
    </div>
	 <!-- LOCK SCREEN WRAPPER-->
    <script>
	 // TIMER FUNCTION
      function startTime()
      {
        var today=new Date();
        var h=today.getHours();
        var m=today.getMinutes();
        var s=today.getSeconds();
        // add a zero in front of numbers<10
        m=checkTime(m);
        s=checkTime(s);
        document.getElementById('time').innerHTML=h+":"+m+":"+s;
        t=setTimeout(function(){
          startTime()}
                     ,500);
      }
      
      function checkTime(i)
      {
        if (i<10)
        {
          i="0" + i;
        }
        return i;
      }
    </script>
  </body>
</html>


