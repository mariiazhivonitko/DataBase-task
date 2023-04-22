<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$playlist_id = 1;

$sql = "SELECT Name, Composer FROM tracks WHERE GenreId=$playlist_id";

$statement = $dbcon->prepare($sql);
$statement->execute();

$tracks = $statement -> fetchAll(PDO::FETCH_ASSOC);
foreach($tracks as $track){
    echo "<h1>".$track["Name"]."</h1>";
    echo "(".$track["Composer"].")<br><hr><br>";
};