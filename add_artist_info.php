<?php
// Lisäys ja parametrit: add_artist_info.php
//a. Tiedosto lisää uuden artistin, sekä lisäksi artistille albumin ja albumin kappaleet.
//Kaikki tarvittavat tiedot saadaan joko POST- tai JSON-muodossa parametreina. Voit
//aloittaa luomalla vain artistin ja albumin.

require "dbconnection.php";
$dbcon = createDbConnection();

$body = file_get_contents("php://input");
$data = json_decode($body);

$artist = strip_tags($data->Name);
$album = strip_tags($data->Title);


$sql = "INSERT INTO artists (ArtistId, Name) VALUES (?,?)";