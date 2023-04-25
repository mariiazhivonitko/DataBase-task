<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$artist_id = 1;

try {
    $dbcon->beginTransaction();

    //Poistaan invoice_itemsista items lityivät tähän artistiin
    $sql = "DELETE FROM invoice_items WHERE TrackId IN
    (SELECT TrackId FROM tracks WHERE AlbumId IN(SELECT AlbumId FROM albums WHERE ArtistId=$artist_id))";
    $statement = $dbcon-> prepare($sql);
    $statement->execute();

    // Poistaan playlist_trackista tämän artistin tracks
    $sql = "DELETE FROM playlist_track WHERE TrackId IN (SELECT TrackId FROM tracks WHERE AlbumId IN(SELECT AlbumId FROM albums WHERE ArtistId=$artist_id))";
    $statement = $dbcon-> prepare($sql);
    $statement->execute();

    //Poistan tracks
    $sql = "DELETE FROM tracks WHERE AlbumId IN(SELECT AlbumId FROM albums WHERE ArtistId=$artist_id)";
    $statement = $dbcon-> prepare($sql);
    $statement->execute();

    //Poistaan albums
    $sql = "DELETE FROM albums WHERE ArtistId=$artist_id";
    $statement = $dbcon->prepare($sql);
    $statement->execute();

    //Poistaan artistia
    $sql = "DELETE FROM artists WHERE ArtistId=$artist_id";
    $statement = $dbcon->prepare($sql);
    $statement->execute();

    $dbcon->commit();

    echo "Artisti poistettu!";


}catch(Exception $e){
    $dbcon->rollBack();
    echo $e->getMessage();
}
