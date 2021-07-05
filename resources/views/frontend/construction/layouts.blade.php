<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="{{ config('website.description') }}">
<meta name="keywords" content="{{ config('website.description') }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ Helper::frontend('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ Helper::frontend('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
@yield('content')	

<!--===============================================================================================-->	
	<script src="{{ Helper::frontend('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ Helper::frontend('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ Helper::frontend('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ Helper::frontend('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ Helper::frontend('vendor/countdowntime/moment.min.js') }}"></script>
	<script src="{{ Helper::frontend('vendor/countdowntime/moment-timezone.min.js') }}"></script>
	<script src="{{ Helper::frontend('vendor/countdowntime/moment-timezone-with-data.min.js') }}"></script>
	<script src="{{ Helper::frontend('vendor/countdowntime/countdowntime.js') }}"></script>
	<script>
		$('.cd100').countdown100({
			// Set Endtime here
			// Endtime must be > current time
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York", can be empty
			// go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ Helper::frontend('vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ Helper::frontend('js/main.js') }}"></script>

</body>
</html>