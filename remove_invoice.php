<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$invoice_item_id = strip_tags($_POST["invoice_item_id"]);
 
$sql = "DELETE FROM invoice_items WHERE invoiceLineId=$invoice_item_id";
$dbcon->exec($sql);