<?php

    $cur_lati = 43.656906;
    $cur_long = -79.434356;

$cate = $_GET['cate'];

getbyCate($cur_lati,$cur_long,$cate,10);


function getbyCate($cur_lati,$cur_long,$cate,$kmfilter){


    include("../includes/destinationInfo.php");

    $SQLhost = "thoughtspot.db.9124079.hostedresource.com";
    $SQLusername = "thoughtspot";
    $SQLpassword = "Nerdsquad14!";
    $SQLdatabase = "thoughtspot";

    mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

    mysql_select_db($SQLdatabase);

    $result = mysql_query("SELECT id,location,description,publicName,category,latitude,longitude,phone,website FROM Locations WHERE category LIKE  '%".$cate."%'");

    $count = 0;

    while(($row = mysql_fetch_array($result,MYSQL_ASSOC)) &&
        ($count < 7) &&
        (distanceFilter($cur_lati, $cur_long, $row["latitude"], $row["longitude"]) <= $kmfilter)) {
                $distance = &distanceFilter($cur_lati, $cur_long, $row["latitude"], $row["longitude"]) <= $kmfilter;
                echo("<hr><p>".$row["publicName"]."</p> - ". $distance." km"."       <a href='../detail/index.php?id=".$row["id"]."'>Detail</a>");
                $count ++;
        }

}

function distanceFilter($cur_lati,$cur_long,$lati,$long){

    include("../includes/destinationInfo.php");


    $distance = walkingDis($cur_lati,$cur_long,$lati,$long);

    $newphrase = substr($distance,0,-3);

    return $newphrase;

}

?>
