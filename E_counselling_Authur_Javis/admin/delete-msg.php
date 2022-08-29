<?php 
include('../DBConnection.php');

$ID= $_GET['id'];        

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

$sql = "delete from messages where id='$ID'";
$result = $conn->query($sql);

header("Location: msg-record.php"); 
 ?>