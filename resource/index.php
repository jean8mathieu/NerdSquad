<?php



getbyCate("Family");


function getbyCate($cur_lati,$cur_long,$cat,$kmfilter){

    $SQLhost = "thoughtspot.db.9124079.hostedresource.com";
    $SQLusername = "thoughtspot";
    $SQLpassword = "Nerdsquad14!";
    $SQLdatabase = "thoughtspot";

    mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

    mysql_select_db($SQLdatabase);


    $result = mysql_query("SELECT location,description,category,latitude,longitude,address1,city,postalCode,phone,website FROM Locations WHERE category LIKE  '%".$cat."%'");

    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
        if(distanceFilter($cur_lati,$cur_long, $row["latitude"],$row["longitude"],$kmfilter))
        printf("Category: %s Location: %s  Latitude: %s Longitude: %s "."<br />\r\n", $row["category"],$row["location"], $row["latitude"], $row["longitude"] );
    }

}

function distanceFilter($cur_lati,$cur_long,$lati,$long,$request_dis){
    include("..includes/destinationInfo.php");



    $distance = walkingDis($cur_lati,$cur_long,$lati,$long);

    $newphrase = chop(" km", $distance);

    if($newphrase <= $request_dis){  //within distance of request
        return true;
    }else{
        return false;
    }

}