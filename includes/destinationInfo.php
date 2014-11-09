<?php

$key = "AIzaSyC1KB-Idnu0DIKC7o0EWIxf7RMJbnblgVQ";



function walkingDis($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=walking&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDistance($result));
}

function walkingDur($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=walking&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDur($result));
}

function drivingDis($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=driving&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDistance($result));
}

function drivingDur($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=driving&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDur($result));
}

function bicyclingDis($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=bicycling&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDistance($result));
}

function bicyclingDur($cur_lati,$cur_long,$lati,$long,$key){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$cur_lati.",".$cur_long."&destinations=".$lati.",".$long."&mode=bicycling&language=en-EN&key=".$key;
    $result = decodeJson($url);
    return (getDur($result));
}

function getDistance($result){
    return $result['rows'][0]['elements'][0]['distance']['text'];
}

function getDuration($result){
    return $result['rows'][0]['elements'][0]['duration']['text'];
}

function decodeJson($url){
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);
return json_decode($result, true);   //decode json
}

?>