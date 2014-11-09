<script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>


<?php

if (isset($_GET["cla"]) && isset($_GET["clo"])) {
    $cur_lati = $_GET["cla"];
    $cur_long = $_GET["clo"];
}else{

}

getbyCate($cur_lati,$cur_long,"Family",5);


function getbyCate($cur_lati,$cur_long,$cate,$kmfilter){


    include("../includes/destinationInfo.php");

    $SQLhost = "thoughtspot.db.9124079.hostedresource.com";
    $SQLusername = "thoughtspot";
    $SQLpassword = "Nerdsquad14!";
    $SQLdatabase = "thoughtspot";

    mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

    mysql_select_db($SQLdatabase);

    $result = mysql_query("SELECT location,description,category,latitude,longitude,address1,city,postalCode,phone,website FROM Locations WHERE category LIKE  '%".$cate."%'");

    $count = 0;

    while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
        $distance = distanceFilter($cur_lati, $cur_long, $row["latitude"], $row["longitude"]);
        if($count <= 10) {
            if ($distance <= $kmfilter) {
                printf("Category: %s  Latitude: %s Longitude: %s Distance from you: %s" . "<br />\r\n", $row["category"], $row["latitude"], $row["longitude"], $distance);
                $count ++;
            }
        }else{
            break;
        }
    }

}

function distanceFilter($cur_lati,$cur_long,$lati,$long){

    include("../includes/destinationInfo.php");


    $distance = walkingDis($cur_lati,$cur_long,$lati,$long);

    $newphrase = substr($distance,0,-3);

    return $newphrase;

}

?>

<script type="text/javascript">

    $(document).ready(){

    navigator.geolocation.getCurrentPosition(locationHandler);

        function locationHandler(position){
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            window.location.href = "index.php?cla=" + lat + "&clo=" + lng;

        }
    }

</script>