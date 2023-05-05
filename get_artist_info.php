<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist_id=7;

$sql = "SELECT Name FROM artists WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$artist = $statement->fetch (PDO::FETCH_ASSOC);
$artistName=$artist["Name"];

$response = new stdClass();
$response -> artist = $artistName;

$response -> albums =Array();

$sql="SELECT Title, AlbumId
FROM albums
WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$titles=$statement->fetchAll(PDO::FETCH_ASSOC);

foreach($titles as $title){
    $album = new stdClass();
    $album -> title = $title["Title"];
    $albumId = $title["AlbumId"];

    $sql="SELECT Name
    FROM tracks
    WHERE AlbumId = $albumId";
    $statement = $dbcon->prepare($sql);
    $statement -> execute();
    $tracks=$statement->fetchAll(PDO::FETCH_COLUMN);

    $album -> tracks = $tracks;

    $response -> albums[] = $album;
}


$json = json_encode($response);
header('Content-type: application/json');
echo $json;