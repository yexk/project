<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
	<title> @yield('title') - Yexk </title>
	<base href="/back/">
	@include('back.layouts.links')
	@yield('links')
</head>
<body>
@include('back.layouts.top')
@include('back.layouts.nav')
      
<!-- BEGIN MAIN CONTENT -->
<section id="main-content">
	<!-- BEGIN WRAPPER  -->
	<section class="wrapper">
		
@yield('content')

    </section>
	<!-- END WRAPPER  -->
</section>
<!-- END MAIN CONTENT -->

@include('back.layouts.bottom')
@include('back.layouts.script')

@yield('scripts')
</body>
</html>