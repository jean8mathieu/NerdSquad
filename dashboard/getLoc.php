
<html>
<head>

</head>
<body onload="getLocation()">

<p id="demo" style="display: none">Click the button to get your coordinates:</p>
<script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        updateLoc(position.coords.latitude, position.coords.longitude)

    }

    function updateLoc(lat, long) {
        window.location = "http://health.jackiehuang.ca/dashboard/setLoc.php?lat=" + lat + "&long=" + long;

    }
</script>
<!--<button onclick="getLocation()">Try It</button>-->


</body>
</html>