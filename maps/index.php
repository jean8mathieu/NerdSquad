<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 6/11/14
 * Time: 6:17 AM
 */

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Maps Test</title>
    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Initialize the Google Maps API v3
        var markers = [];
        var map;
        var x = 0;
        var infoWindow;
        var marker;
        var markersArray = [];
        var customIcons = {
            0: {
                icon: 'images/mm_20_green.png'
            },
            1: {
                icon: 'images/mm_20_red.png'
            }
        };

        function load() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(47.6145, -122.3418),
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
        }

        function clearOverlays() {
            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }
        }

        function autoUpdate() {

            clearOverlays();
            downloadUrl("generateXML.php", function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName("marker");
                console.log(markers);
                for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute("id");
                    var address = markers[i].getAttribute("address");
                    var type = markers[i].getAttribute("alert");
                    var point = new google.maps.LatLng(
                        parseFloat(markers[i].getAttribute("lat")),
                        parseFloat(markers[i].getAttribute("lng")));
                    var html = "<b>" + name + "</b>";
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

            // Call the autoUpdate() function every 5 seconds
            setTimeout(autoUpdate, 5000);
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
        autoUpdate();
    </script>
</head>
<body onload="load()">
<section id="main" class="column">
    <!--<h4 class="alert_info">Welcome on the administration page! Made by <a href="http://jmdev.ca">JMDev</a></h4>
    ?>-->

    <div id="map" style="width: 1400px;height: 850px"/>
    <!--<article class="module width_3_quarter">
    </article>-->
    <div class="spacer"></div>
</section>


</body>
</html>