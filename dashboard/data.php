<?php

    session_start();
    $cur_lati = $_SESSION['lat'];
    $cur_long = $_SESSION['long'];

$cate = $_GET['cate'];
$kmfilter = $_GET['radius'];
$_SESSION['radius'] = $kmfilter;

getbyCate($cur_lati,$cur_long,$cate,$kmfilter);


function getbyCate($cur_lati,$cur_long,$cate,$kmfilter){

    include("../includes/destinationInfo.php");

    $SQLhost = "thoughtspot.db.9124079.hostedresource.com";
    $SQLusername = "thoughtspot";
    $SQLpassword = "Nerdsquad14!";
    $SQLdatabase = "thoughtspot";

    mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

    mysql_select_db($SQLdatabase);

    $result = mysql_query("
SELECT * ,
( 6371 * ACOS( COS( RADIANS($cur_lati ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS($cur_long ) ) + SIN( RADIANS($cur_lati) ) * SIN( RADIANS( latitude ) ) ) )
AS distance
FROM Locations
WHERE category LIKE  '%".$cate."%'
HAVING distance <".$kmfilter."
ORDER BY distance ASC");


    while(($row = mysql_fetch_array($result,MYSQL_ASSOC)) ) {
                //$distance = &distanceFilter($cur_lati, $cur_long, $row["latitude"], $row["longitude"]) <= $kmfilter;
                echo("<hr><p>".$row["publicName"]."</p>".
                    displayHourOperation($row["hoo"])
                    .round($row['distance'],2)." km"."       <a href='../detail/index.php?id=".$row["id"]."'>Detail</a>");
        }

}

function distanceFilter($cur_lati,$cur_long,$lati,$long){

    include("../includes/destinationInfo.php");


    $distance = walkingDis($cur_lati,$cur_long,$lati,$long);

    $newphrase = substr($distance,0,-3);

    return $newphrase;

}

function displayHourOperation($hour){
    if(strlen($hour) > 1){
        return ("<p>Hour of Operation:".$hour."</p>");
    }

}

?>
