<?php
require "dbconnection.php";
$dbcon = createDbConnection();

$invoice_item_id = 10;
 
$sql = "DELETE FROM invoice_items WHERE invoiceLineId=$invoice_item_id";
$dbcon->exec($sql);