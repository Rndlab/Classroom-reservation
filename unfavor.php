<?php
session_start();
$Id=$_SESSION['Id'];
$room_id=$_GET['id'];  

include_once('connect.php');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("reserve", $con);

mysql_query("DELETE FROM favor WHERE room_id = $room_id and user_id = $Id");
echo "<script>location='myorder.php'</script>";

mysql_close($con);
?>