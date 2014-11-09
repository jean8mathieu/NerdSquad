<?php

require("connection.php");
session_start();
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server
$connection=mysql_connect ($SQLhost, $SQLusername, $SQLpassword);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($SQLdb_name, $connection);
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$category = $_GET['category'];
$radius = $_GET['radius'];
$lat = $_GET['lat'];
$long = $_GET['long'];
if(isset($_GET['category'])){
    $query = "SELECT * ,
( 6371 * ACOS( COS( RADIANS($lat ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS($long ) ) + SIN( RADIANS($lat) ) * SIN( RADIANS( latitude ) ) ) )
AS distance
FROM Locations
WHERE category LIKE  '%".$category."%'
HAVING distance <".$radius."
ORDER BY distance ASC";
}else{
    $query = "SELECT * ,
( 6371 * ACOS( COS( RADIANS($lat ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS($long ) ) + SIN( RADIANS($lat) ) * SIN( RADIANS( latitude ) ) ) )
AS distance
FROM Locations
WHERE HAVING distance <".$radius."
ORDER BY distance ASC";
}
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each


while ($row = @mysql_fetch_assoc($result)){
    // ADD TO XML DOCUMENT NODE


    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['id']);
    $newnode->setAttribute("title",utf8_encode($row['incidentTitle']));
    $newnode->setAttribute("desc",utf8_encode($row['description']));
    $newnode->setAttribute("location",utf8_encode($row['location']));
    $newnode->setAttribute("lat",utf8_encode($row['latitude']));
    $newnode->setAttribute("lng",utf8_encode($row['longitude']));
    $newnode->setAttribute("category",utf8_encode($row['category']));
    $newnode->setAttribute("alert",getLogo($row['category']));

    //getLogo($row['category']);

}

echo $dom->saveXML();


function getLogo($category){
    $arrays = explode(",", $category);
/*
    for($i=0;$i<count($arrays);$i++){
        echo ($arrays[$i] . " ");
        if(strlen($arrays[1]) <= 1){
            echo "NULL <br>";
        }else{
            echo "<br>";
        }
    }
*/
    if(isset($_GET['category']) && strlen($_GET['category']) > 1){
        if($_GET['category'] == "Work and School"){
            return 1;
        }elseif($_GET['category'] == "Spirituality and Wellbeing"){
            return 2;
        }elseif($_GET['category'] == "Recreation and Culture"){
            return 3;
        }elseif($_GET['category'] == "Legal and Financial"){
            return 4;
        }elseif($_GET['category'] == "Health and Social Services"){
            return 5;
        }elseif($_GET['category'] == "Family and Friends"){
            return 6;
        }elseif($_GET['category'] == "Sex and Relationships"){
            return 7;
        }else{
            return 0;
        }
    }else{
        if(strlen($arrays[1]) <= 1){
            if($arrays[0] == "Work and School"){
                return 1;
            }elseif($arrays[0] == "Spirituality and Wellbeing"){
                return 2;
            }elseif($arrays[0] == "Recreation and Culture"){
                return 3;
            }elseif($arrays[0] == "Legal and Financial"){
                return 4;
            }elseif($arrays[0] == "Health and Social Services"){
                return 5;
            }elseif($arrays[0] == "Family and Friends"){
                return 6;
            }elseif($arrays[0] == "Sex and Relationships"){
                return 7;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
