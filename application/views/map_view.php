<head>
<!-- Place this data between the <head> tags of your website -->
<meta name="description" content="Your Local Courier. Fast online quotes, Easy to use. Central to Brisbane, Ipswich, and Gold Coast, we are ready courier anything you need moved.">
<meta name="keywords" content="Courier service, Gold Coast, Brisbane, Ipswich, online quote">
<link rel="icon" type="image/x-icon" href="c1.jpg" /> 
	
	
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	
<meta name="viewport" content="width=device-width, initial-scale=1">


	
	<script>
		src = "http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

	<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&dummy=.js"></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>

	<!--style-->
	
	
	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://www.courier1.com.au/bootstrap/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="http://www.courier1.com.au/bootstrap/js/bootstrap.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37998972-5', 'auto');
  ga('send', 'pageview');
</script>
	
</head>










	<!-- Autocomplete Section-->

	<script type="text/javascript">
		function initialize() {
			var input = document.getElementById('Origin');
			var options = {
				componentRestrictions: {
					country: 'au'
				}
			};
			new google.maps.places.Autocomplete(input, options);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>

	<script type="text/javascript">
		function initialize() {
			var input = document.getElementById('Destination');
			var options = {
				componentRestrictions: {
					country: 'au'
				}
			};
			new google.maps.places.Autocomplete(input, options);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>

	<!-- Autocomplete End-->

	<!-- Calculate Distance-->


	<script>
		var map;
		var geocoder;
		var bounds = new google.maps.LatLngBounds();
		var markersArray = [];
		var origin1 = 'Ormeau, Queensland';
		var origin2 = 'Ormeau , Queensland';
		var destinationA = 'Beenleigh, Queensland';
		var destinationB = 'Beenleigh , Queensland';
		var distance = 0
		var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
		var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';
		/* //first get the value of the radio button
var GetSize = document.getElementsByName('sizeRadio');
for (var i = 0, length = radios.length; i < length; i++) {
	if (radios[i].checked) {
		// do whatever you want with the checked radio
		alert(radios[i].value);
		// only one radio can be logically checked, don't check the rest
		break;
	}
} */
		function initializeDistCalc() {
			var opts = {
				center: new google.maps.LatLng(-27.642355, 153.142960),
				zoom: 10
			};
			map = new google.maps.Map(document.getElementById('map-canvas'), opts);
			geocoder = new google.maps.Geocoder();
		}
		function calculateDistances() {
			var service = new google.maps.DistanceMatrixService();
			var home = 'Ormeau , Queensland';
			var origin1 = document.getElementById('Origin').value;
			var destinationA = document.getElementById('Destination').value;
			var homeFinish = 'Ormeau , Queensland';
			var Weight = document.getElementById('Weight').value;
			if (!$("input[name='dest_type']:checked").val()) {
				alert('Please select a size from the available options.');
			} else {
				if (document.getElementById('laptop').checked) {
					var size = 1.2;
				} else if (document.getElementById('barfridge').checked) {
					var size = 1.5;
				} else if (document.getElementById('fridge').checked) {
					var size = 2.4;
				} else if (document.getElementById('fridgebig').checked) {
					var size = 2.9;
				}
				service.getDistanceMatrix({
					origins: [home, origin1,],
					destinations: [destinationA, homeFinish],
					
					travelMode: google.maps.TravelMode.DRIVING,
					unitSystem: google.maps.UnitSystem.METRIC,
					avoidHighways: false,
					avoidTolls: false
				}, callback);
			}
		}
		function callback(response, status) {
			if (status != google.maps.DistanceMatrixStatus.OK) {
				alert('Error was: ' + status);
			} else {
				var origins = response.originAddresses;
				var destinations = response.destinationAddresses;
				var distance = 0;
				
				var outputDiv = document.getElementById('outputDiv');
				outputDiv.innerHTML = '';
				deleteOverlays();
				for (var i = 0; i < origins.length; i++) {
					var results = response.rows[i].elements;
					addMarker(origins[i], false);
					for (var j = 0; j < results.length; j++) {
						addMarker(destinations[j], true);
						var raw = ((size.value) * (results[j].duration.value) / 60)
						if (raw < 1) {
							//alert('its less than 55' + raw);
							var price = 2;
						} else {
							var price = Math.ceil(raw);
							//alert('the price is ' + price);
						}
						//alert(raw);
distance = (distance + price);
						//distance.push(price);
//alert(distance);
						//This is the Bit that prints the results to the screen.
						//Redundant code below. Modified to just output the time.
						//outputDiv.innerHTML += origins[i] + ' to ' + destinations[j] + ': ' + results[j].distance.text + ' in ' + results[j].duration.text + '<br>';
						//outputDiv.innerHTML += origins[i] + ' to ' + destinations[j] + ': ' + results[j].distance.text + ' in ' + results[j].duration.text + '<br>' + (Weight.value);
						
					}
				}
				outputDiv.innerHTML += '<div class="alert alert-success" role="alert">Your courier quote is $' + (distance) + '</div>';
				
			}
		}
		function addMarker(location, isDestination) {
			var icon;
			if (isDestination) {
				icon = destinationIcon;
			} else {
				icon = originIcon;
			}
			geocoder.geocode({
				'address': location
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					bounds.extend(results[0].geometry.location);
					map.fitBounds(bounds);
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						icon: icon
					});
					markersArray.push(marker);
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}
			});
		}
		function deleteOverlays() {
			for (var i = 0; i < markersArray.length; i++) {
				markersArray[i].setMap(null);
			}
			markersArray = [];
		}
		google.maps.event.addDomListener(window, 'load', initializeDistCalc);
		 <!-- END Calculate Distance-->
	</script>


	<script type='text/javascript'>
		//<![CDATA[ 
		$(window).load(function() {
			$('input[name="dest_type"]').on('change', function() {
				$('input[id="size"]').val($(this).val());
				//   $('input[type="text"]').val('');
			});
		}); //]]>
	</script>






	


<div class="container-fluid" <div class="row">
	<div class="col-md-12">
				
		<div class="page-header">
  <h1>Courier1 <small>Instant online quotes.</small></h1>
</div>
		
		




<body onload="initialize()">

<div class="container-fluid">
		<div class="row">

			<div class="col-md-4">


				<div id="inputs">


					<FORM NAME="test">

						<H1>Get an instant quote!</H1>
						<h4>Pickup Location:</h4>
						<INPUT TYPE="TEXT" ID="Origin" NAME="Pickup" style="width: 100%;">
						<h4>Drop off Location:</h4>
						<INPUT TYPE="TEXT" ID="Destination" NAME="DropOff" style="width: 100%;">
						<h4>Parcel Weight (kg):</h4>
						<INPUT TYPE="hidden" ID="Weight" NAME="Weight" style="width: 80%;">
						<h4>Please select the closest size of your item:</h4>
						<div>
							<input name="dest_type" id="laptop" value="1" type="radio" />
							<label for="radio3">Smaller than a Laptop</label>
							<br>
							<input name="dest_type" id="barfridge" value="1.2" type="radio" />
							<label for="radio4">Smaller than a bar fridge</label>
							<br>
							<input name="dest_type" id="fridge" value="1.5" type="radio" />
							<label for="radio5">Smaller than a fridge</label>
							<br>
							<input name="dest_type" id="fridgebig" value="1.6" type="radio" />
							<label for="radio5">Larger than a fridge</label>
							<br>
						</div>
						<br>
						<input type="hidden" id="size">
					</FORM>

					<p>

						<div id="outputDiv"></div>
						<a class="btn btn-primary" role="button" onclick="calculateDistances();">Quote me!</a>
							<a class="btn btn-primary" href="contact-our-courier-service.php">Contact us</a>
							

					</p>

				</div>
			</div>

			<div class="col-md-8">
				<div id="map-canvas" style="height:400px; width:auto;"></div>
			</div>

		</div>

	</div>

	</div>
	<!-- /.container-fluid -->

</body>

<style>
	#content-pane {
		float: right;
		width: 48%;
		padding-left: 2%;
	}
	#outputDiv {
		font-size: 11px;
	}
</style>

</html>