<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stylesheets/form.css">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title>Enter Report</title>
</head>

<body>
    <nav class="navbar">
		<div class="logo">
			<a href="index.php"><img class="logopic" alt="MattDaan Logo" src="img/logo.png"></a>
		</div>
		<ul class="butlist">
			<span class="butres">
				<li><a href="about.php">ABOUT</a></li>
				<li><a href="news.php">NEWSFEED</a></li>
				<li style="float:left;"><a href="news.php">MATT&nbsp;DAAN</a></li>
			</span>
		</ul>
	</nav>

	<div class="container">
		<div class="col1">
			<form id="contact" action="includes/complaintform2.inc.php" method="post" enctype="multipart/form-data" onsubmit="return formValidation();" name="report">
				<h3 class="submithead">Submit a Report</h3>
				<h4>Fill up the form</h4>
				<input placeholder="Your name"  type="text" id="fname" tabindex="1" required="true" autofocus name="name">
				<input placeholder="Your Email Address" type="email" id="email" tabindex="2" required="true" name="email">
				<input placeholder="Your VoterID" type="text" tabindex="3" required="true" name="voter_id">
				<input placeholder="Your Response" type="text" tabindex="3" required="true" name="response">
				<input placeholder="Date" type="text" tabindex="3" required="true" name="date">
				<input type="file" accept="image/*" name="imageUpload">
				<input style="opacity: 0" type="hidden" id="lat" name="lat" novalidate>
				<input style="opacity: 0" type="hidden" id="lng" name="lng" novalidate>
				<button name="submit" type="submit" id="contact-submit" value="submit" >Send OTP</button>
			</form>
		</div>
		<div class="col2">
			<button type="button" id="get_loc" onclick="chooseLoc();return;">Get your Location</button>
			<div id="map"></div>
		</div>
	</div>

	<script>
		var map;
		var coords;
		var yourMarker;
		var lat=0;
		var lng=0;

		function getLoc() {
			lat=yourMarker.getPosition().lat();
			lng=yourMarker.getPosition().lng();
			document.getElementById("lat").value=lat;
			document.getElementById("lng").value=lng;
			console.log(document.getElementById("lat").value);
			console.log(document.getElementById("lng").value);
		}

		function chooseLoc(){
			navigator.geolocation.getCurrentPosition(function(pos){
				coords={lat:pos.coords.latitude,lng:pos.coords.longitude};
				console.log(coords);
				yourMarker = new google.maps.Marker({position: coords,title:"You",icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png', map: map});
				getLoc();
			}, function(error){
				alert("Choose your location");
				console.log(error)
				yourMarker = new google.maps.Marker({position: {lat:20.5937,lng:78.9629},title:"You",icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png', map: map,draggable:true});
				getLoc();
				}, {
				enableHighAccuracy: true,
				timeout: 5000,
				maximumAge: 0
				});
		}
		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: {lat:20.5937,lng:78.9629}});
		}
	</script>
	    <script type="text/javascript" charset="utf-8">
	function formValidation() {
	if (isEmpty(document.getElementById('fname').value.trim())) {
	alert('name is required!');
	return false;
	}
	if (isEmpty(document.getElementById('email').value.trim())) {
	alert('Email is required!');
	return false;
	}
	if (!validateEmail(document.getElementById('email').value.trim())) {
	alert('Email must be a valid email address!');
	return false;
	}
	return true;
	}
	function isEmpty(str) { return (str.length === 0 || !str.trim()); }
	function validateEmail(email) {
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
	return isEmpty(email) || re.test(email);
	}

	</script>

	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQX9reaTqze5_cxq1sMlU_uQIkLt1n4ZY&callback=initMap">
	</script>
</body>
</html>
