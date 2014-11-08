<?php

$lati = $_GET['lati'];
$long = $_GET['long'];

$json = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=43.65807,-79.378394&destinations=".$lati.",".$long."&mode=bicycling&language=en-EN&key=AIzaSyC1KB-Idnu0DIKC7o0EWIxf7RMJbnblgVQ";

$ch = curl_init($json);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);

$final = $result['rows'][0]['elements'][0]['distance']['text'];

print_r ($final);

?>