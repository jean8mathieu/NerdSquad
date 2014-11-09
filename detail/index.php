<?php

$uid = $_GET['id'];

$SQLhost = "thoughtspot.db.9124079.hostedresource.com";
$SQLusername = "thoughtspot";
$SQLpassword = "Nerdsquad14!";
$SQLdatabase = "thoughtspot";

mysql_connect($SQLhost,$SQLusername,$SQLpassword) or die ("Could not connect: ".mysql_error());

mysql_select_db($SQLdatabase);

$result = mysql_query("SELECT location,description,category,phone,website,publicName,hoo,faa FROM Locations WHERE id =".$uid);

$row = mysql_fetch_array($result,MYSQL_ASSOC);

echo ("-------------------------------". "<br />\r\n");
echo ("Name: ".$row['publicName']. "<br />\r\n");
echo ("Category: ".$row['category']. "<br />\r\n");
echo ("Location: ".$row['location']. "<br />\r\n");
echo ("Hours of operation: ".$row['hoo']. "<br />\r\n");
echo ("Description: ".$row['description']. "<br />\r\n");
echo ("--------------------------------");


?>

