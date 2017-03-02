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
$sql="INSERT INTO favor (room_id,user_id)
VALUES
('$room_id', '$Id')";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<script>location='myorder.php'</script>";

mysql_close($con);
?>