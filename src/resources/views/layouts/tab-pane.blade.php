<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="Tab-pane/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Tab-pane/css/font-awesome.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="Tab-pane/css/style.css"/>
</head>
<body>
    <div id="app">
        <main>
            @yield('content-tab')
        </main>
    </div>
	<script src="Tab-pane/js/jquery-3.3.1.slim.min.js" defer></script>
	<script src="Tab-pane/js/bootstrap.bundle.min.js" defer></script>
	<script src="Tab-pane/js/main.js" defer></script>
</body>
</html>