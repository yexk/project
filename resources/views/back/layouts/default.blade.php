<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
	<title>Document</title>
	@include('back.layouts.links')
</head>
<body>
@include('back.layouts.top')

@yield('content')

@include('back.layouts.bottom')
@include('back.layouts.script')
</body>
</html>