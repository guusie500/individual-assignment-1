<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Navbar Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="navbar.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<!--<script src="/assets/js/ie-emulation-modes-warning.js"></script>-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="container">
			<!-- Static navbar -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Project name</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li role="separator" class="divider"></li>
									<li class="dropdown-header">Nav header</li>
									<li><a href="#">Separated link</a></li>
									<li><a href="#">One more separated link</a></li>
								</ul>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
							<li><a href="../navbar-static-top/">Static top</a></li>
							<li><a href="../navbar-fixed-top/">Fixed top</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
			<div id="mapholder" class="container" style="height:500px;width:100%;">
				<div id="map" style="overflow:visible;"></div>
				<div id="buslist" height="50px"></div>
			</div>
		</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="/dist/js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
		
		<!-- jQuery import -->
		<script src="jquery-3.1.1.js"></script>
		
		<!-- Google maps api and setup -->
		<script src="mapoptions.js"></script>
		<script src="buslines.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXyiw3gwfcn8dz9lc0bGX2iABk7Z2rhVY&callback=initMap" async defer></script>
		<script>
			var map;
			var dir;
		
			function initMap() {
				// Create a map object and specify the DOM element for display.
				map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: 51.4867272, lng: 5},
					scrollwheel: true,
					zoom: 9,
					styles: options
				});
				dir = new google.maps.DirectionsService();
				createLines(google.maps.UnitSystem.METRIC);
				
				google.maps.event.trigger(map, "resize");
			}
			
			function display(line){
				directionsDisplay = new google.maps.DirectionsRenderer();
				directionsDisplay.setMap(map);
				directionsDisplay.setDirections(line);
				google.maps.event.trigger(map, "resize");
			}
			
			function showLine(lines){
				console.log("Creating bus line from " + lines[0].origin + " to " + lines[0].destination);
				dir.route(lines[0],function(response,status){
					if (status == 'OK') {
						display(response);
						lines.splice(0, 1);
						if (lines.length > 0){
							showLine(lines);
						}
					}
				});
			}

		</script>
		
		<!-- http bulsines shizzle 
		<script type="text/javascript">
			function httpGetAsync(theUrl, callback)
			{
				var xmlHttp = new XMLHttpRequest();
				xmlHttp.onreadystatechange = function() { 
					if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
						callback(xmlHttp.responseText);
				}
				xmlHttp.open("GET", theUrl, true); // true for asynchronous 
				xmlHttp.send(null);
			}
			
			httpGetAsync("http://api.ovstatus.nl/stadstreek/haltes.php",null);
		</script>
		-->
	</body>
</html>
