<?php
session_start();
$Id=$_SESSION['Id'];
$order_id=$_GET['id'];  

include_once('connect.php');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("reserve", $con);

mysql_query("DELETE FROM room_order WHERE Id=$order_id");
echo "<script>location='myorder.php'</script>";

mysql_close($con);
?>