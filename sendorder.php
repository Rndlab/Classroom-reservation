<?php
session_start();
$Id=$_SESSION['Id'];
$year=$_GET['year'];  
$day=$_GET['day']; 
$month=$_GET['month']; 
$classroom=$_GET['classroom']; 
$phone=$_GET['phone']; 
$usage=$_GET['usage']; 
$start=$_GET['start'];
$end=$_GET['end'];
$order_date=$year."-".$month."-".$day;
include_once('connect.php');
mysql_select_db("reserve", $con);


$sql="INSERT INTO room_order (room_id,user_id,order_date,order_time_start,order_time_end,useage,phone)
VALUES
('$classroom', '$Id', '$order_date', '$start','$end','$usage','$phone')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<script>location='myorder.php'</script>";


mysql_close($con);
?>