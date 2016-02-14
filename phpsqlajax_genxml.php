<?php

require("config.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection = mysql_connect ('localhost', DB_USER, DB_PASS);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db(DB_NAME, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM s_restaurants WHERE 1";
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
  $newnode->setAttribute("res_name",$row['res_name']);
  $newnode->setAttribute("cuisine",$row['cuisine']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("area", $row['area']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['long']); 
}

echo $dom->saveXML();

?>