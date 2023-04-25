<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist_id=2;

$sql = "SELECT Name FROM artists WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$artist = $statement->fetch (PDO::FETCH_ASSOC);
$artistName=$artist["Name"];



$sql="SELECT Title
FROM albums
WHERE ArtistID=$artist_id";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$titles=$statement->fetchAll(PDO::FETCH_COLUMN);

foreach($titles as $title){
    $sql="SELECT Name
    FROM tracks
    WHERE AlbumId = (SELECT AlbumId FROM albums WHERE Title=$title)";
    $statement = $dbcon->prepare($sql);
    $statement -> execute();
    $tracks=$statement->fetchAll(PDO::FETCH_ASSOC);
}

/*
    $sql="SELECT Name
    FROM tracks
    WHERE AlbumId = (SELECT AlbumId FROM albums WHERE Title=$title)";
$sql="SELECT Name
FROM tracks, albums
WHERE albums.AlbumId = tracks.AlbumId AND Title IN $title";
$statement = $dbcon->prepare($sql);
$statement -> execute();
$tracks=$statement->fetchAll(PDO::FETCH_ASSOC);
 
$albums = array("title"=> $title, "tracks"=> $tracks);

$response = array("artist"=>$artist, "albums"=>$albums); */

$response = array("artist"=>$artistName, "album"=>$titles);

$json = json_encode($response);
header('Content-type: application/json');
echo $json;