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
    <style>
      html, body, #map {
        height: 100%;
        margin: 0px;
        padding: 0px;
      }
      #combo {
        position: fixed;
        top: 5px;
        left: 50%;
        margin-left: -55px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      </style>
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
                name: 'Parking',
                icon: 'images/school.png'
            },
            2: {
                icon: 'images/spirituality.png'
            },
            3: {
                icon: 'images/recreation.png'
            },
            4: {
                icon: 'images/legal.png'
            },
            5: {
                icon: 'images/health.png'
            },
            6: {
                icon: 'images/family.png'
            },
            7: {
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
                for (var key in icons) {
                    var type = icons[key];
                    var name = type.name;
                    var icon = type.icon;
                    var div = document.createElement('div');
                    div.innerHTML = '<img src="' + icon + '"> ' + name;
                    legend.appendChild(div);
                }
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
            domain = domain + "?category=" + e;
            //alert(domain);
            update();
        }

    </script>
</head>
<body onload="initialize();">
    <div id="map"></div>
    <div id="combo">
        <select id="category" onchange="getCategory();">
            <option value=""></option>
            <option value="Family%20and%20Friends">Family & Friends</option>
            <option value="Legal%20and%20Financial">Legal & Financial</option>
            <option value="Health%20and%20Social%20Services">Health & Social</option>
            <option value="Recreation%20and%20Culture">Recreation & Culture</option>
            <option value="Family%20and%20Friends">Family & Friends</option>
            <option value="Spirituality%20and%20Wellbeing">Spirituality & Wellbeing</option>
            <option value="Work%20and%20School">Work & School</option>
            <option value="Sex%20and%20Relationships">Sex & Relationships</option>
        </select>
    </div>
    <div id="legend">
        
    </div>
     </body>
</html>