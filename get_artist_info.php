<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist_id=1;

$sql = "SELECT Name FROM artists WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$artist=$statement;


$sql="SELECT Title
FROM albums
WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$title=$statement;

$sql="SELECT Name
FROM tracks, albums
WHERE albums.AlbumId = tracks.AlbumId AND Title IN $title";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$tracks=$statement;

/* $albums = array("title"=> $title, "tracks"=> $tracks);

$response = array("artist"=>$artist, "albums"=>$albums);

$json = json_encode($response);
header('Content-type: application/json');
echo $json; */