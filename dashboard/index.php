<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>NerdSquad</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this templates -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/panel.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,600,700' rel='stylesheet' type='text/css'>
		<!--<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">-->


        <script>
            var radiusValue;
            function something(){
                var answer =  prompt("Please enter your thoughts!");
                return answer;
            }

            function showValue(newValue){
                document.getElementById("rangeValue").innerHTML=newValue + " km";
                var radius = document.getElementById("range").value;
                radiusValue = radius;
            }



        </script>
        <?php

        if((strlen($_SESSION['lat']) < 1)){
            include("getLoc.php");
        }
         ?>
        <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            // Initialize the Google Maps API v3
            var domain = "generateXML.php";
            var markers = [];
            var map;
            var x = 0;
            var infoWindow;
            var marker;
            var markersArray = [];
            var customIcons = {
                0: {
                    name: 'All Categories',
                    icon: 'images/all.png'
                },
                1: {
                    name: 'School & Work',
                    icon: 'images/school.png'
                },
                2: {
                    name: 'Spirituality & Wellbeing',
                    icon: 'images/spirituality.png'
                },
                3: {
                    name: 'Recreation & Culture',
                    icon: 'images/recreation.png'
                },
                4: {
                    name: 'Legal & Financial',
                    icon: 'images/legal.png'
                },
                5: {
                    name: 'Health & Social Services',
                    icon: 'images/health.png'
                },
                6: {
                    name: 'Family & Friends',
                    icon: 'images/family.png'
                },
                7: {
                    name: 'Sex & Relationships',
                    icon: 'images/sex.png'
                }
            };

            function initialize() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(43.6558658, -79.380568),
                    zoom: 10,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                infoWindow = new google.maps.InfoWindow;

                navigator.geolocation.getCurrentPosition(function (position) {


                    var newPoint = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                    x++;
                    if (x === 1) {
                        console.log(newPoint);
                        map.setCenter(newPoint);
                    }
                });

                update();
                var legend = document.getElementById('legend');
                for (var key in customIcons) {
                    var type = customIcons[key];
                    var name = type.name;
                    var icon = type.icon;
                    var div = document.createElement('div');
                    div.innerHTML = '<img src="' + icon + '"> ' + name;
                    legend.appendChild(div);
                }
                map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
            }

            function clearOverlays() {
                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }
            }



            function update(){
                clearOverlays();
                downloadUrl( domain, function (data) {
                    var xml = data.responseXML;
                    var markers = xml.documentElement.getElementsByTagName("marker");
                    console.log(markers);
                    for (var i = 0; i < markers.length; i++) {
                        var title = markers[i].getAttribute("title");
                        var desc = markers[i].getAttribute("desc");
                        var location = markers[i].getAttribute("location");
                        var category = markers[i].getAttribute("category");
                        var type = markers[i].getAttribute("alert");
                        var point = new google.maps.LatLng(
                            parseFloat(markers[i].getAttribute("lat")),
                            parseFloat(markers[i].getAttribute("lng")));
                        var html = "<b>" + title + "<br>" + location + "<br>" + category + + "</b>";
                        var icon = customIcons[type] || {};
                        marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            icon: icon.icon
                        });
                        markersArray.push(marker);

                        bindInfoWindow(marker, map, infoWindow, html);
                    }
                });

            }

            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;

                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }
            function doNothing() {
            }

            function getCategory(){
                var e = document.getElementById('category').value;
                domain = "generateXML.php";
                domain = domain + "?category=" + e + "&radius=" <?php echo($_SESSION['radius']); ?>;
                //alert(domain);
                update();
            }

        </script>

	</head>
	<body onload="initialize();">   
		<!----------------Creating the navigation panel---------------------->
		<header>
			<div class="navbar navbar-inverse navbar-fixed-top " role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<p id="profile">MindFree</p>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right" id="mainmenu">
							<li ><a href="" onclick="something()"><span class="glyphicon glyphicon-question-sign"></span> How're you feeling</a></li>
							
							<li ><a style="" href=""><span class="glyphicon glyphicon-user" ></span> Thoughts</a></li>	
							
							<li ><a href=""><span class="glyphicon glyphicon-envelope" ></span> Contact a specialist</a></li>


						</ul>
					</div>
				</div>
			</div>
		</header>
		<!------------------------------------------------------------------->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset" id="right-panel">
            <h1>ThoughtSpot Resources</h1>
			<!--Create 'search' element -->
				<form action="">
					  <input id="search" type="search"  name="googlesearch">
					  <input type="image" src="../images/loupe1.png" alt="Submit" style="width:15px; height:15px;"><br><span id="rangeValue">5 km</span><br>
                    <input name ="references" type="range" min="1" max="100" value="5" id="range" onChange="showValue(this.value)"/>
				</form>
			<br>
			<p class="show">Show me:  </p>

			<div class="dropdown dropdown-right">
                            <p class=" dropdown-show" data-toggle="dropdown" id="resourcename">all resources <span class="glyphicon glyphicon-collapse-down" ></span></p>
				<ul class="dropdown-menu" role="menu">
                  <li><a href="#" onClick="recp('Family')" > Family and Friends </a></li>
                  <li><a href="#" onClick="recp('Health')" > Health and Social Services </a></li>
                  <li><a href="#" onClick="recp('Legal')" > Legal and Financial  </a></li>
				  <li><a href="#" onClick="recp('Recreation')" > Recreation and Culture </a></li>
				  <li><a href="#" onClick="recp('Spirituality')" > Spirituality and Wellbeing </a></li>
                  <li><a href="#" onClick="recp('Work')" > Work and School </a></li>
                  <li><a href="#" onClick="recp('Sex')" > Sex and Relationships </a></li>
                </ul>
			</div>

				<div id="list">
				</div>
          </div>
        </div><!-- /.blog-sidebar -->

		<div id="bodycontainer">
            <div id="map"></div>
		</div> <!-- /container -->

	<footer class="footer">
       <p id="footer">MindFree &copy;</p>
    </footer>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../js/ie10-viewport-bug-workaround.js"></script>
		<script src="../js/ie-emulation-modes-warning.js"></script>

        <script type="text/javascript">
            function recp(cate) {
                $('#list').load('data.php?cate=' + cate + "&radius=" + document.getElementById("range").value);
                //alert(radiusValue);
                //alert("data.php?cate=" + cate + "&radius=" + showValue());
                if(cate == "Family"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Family and Friends";


                }else if(cate == "Health"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Health and Social Services";

                }else if(cate == "Legal"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Legal and Financial";

                }else if(cate == "Recreation"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Recreation and Culture";

                }else if(cate == "Spirituality"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Spirituality and Wellbeing";

                }else if(cate == "Work"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Work and School";

                }else if(cate == "Sex"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Sex and Relationships";

                }

            }
        </script>
	</body>
</html>