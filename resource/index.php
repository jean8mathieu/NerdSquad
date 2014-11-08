<?php



getbyCate("Family");


function getbyCate($cat){

    $SQLhost = "thoughtspot.db.9124079.hostedresource.com";
    $SQLusername = "thoughtspot";
    $SQLpassword = "Nerdsquad14!";
    $SQLdatabase = "thoughtspot";

    mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

    mysql_select_db($SQLdatabase);


    $result = mysql_query("SELECT location,description,category,latitude,longitude,address1,city,postalCode,phone,website FROM Locations WHERE category LIKE  '%".$cat."%'");

    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
        printf("Category: %s Location: %s  Latitude: %s Longitude: %s "."<br />\r\n", $row["category"],$row["location"], $row["latitude"], $row["longitude"] );
    }



}