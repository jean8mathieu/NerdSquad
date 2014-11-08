<?php

$lati = $_GET['lati'];
$long = $_GET['long'];
$mode = $_GET['mode'];
$key = "AIzaSyC1KB-Idnu0DIKC7o0EWIxf7RMJbnblgVQ";

function walking($cur_lati,$cur_long,$lati,$long,$key){
    return "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=walking&language=en-EN&key=".$key;
}

function driving($cur_lati,$cur_long,$lati,$long,$key){
    return "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=drving&language=en-EN&key=".$key;
}

function bicycling ($cur_lati,$cur_long,$lati,$long,$key){
    return "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=bicycling&language=en-EN&key=".$key;
}

function getDistance($result){
    return $result['rows'][0]['elements'][0]['distance']['text'];
}

function getDuration($result){
    return $result['rows'][0]['elements'][0]['duration']['text'];
}

if($mode == "w")
    $url = walking($cur_lati,$cur_long,$lati,$long,$key);
else if($mode == 'd')
    $url = driving($cur_lati,$cur_long,$lati,$long,$key);
else if($mode == 'b')
    $url = bicycling($cur_lati,$cur_long,$lati,$long,$key);
else
    print "ERROR";
    

$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);   //decode json

print_r (getDistance($result));
print_r(getDuration($result));
?>