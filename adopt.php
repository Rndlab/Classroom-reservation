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

mysql_query("UPDATE room_order SET review = 1
WHERE Id = $order_id");

$result = mysql_query("SELECT * FROM room_order 
	WHERE Id = $order_id");
$row = mysql_fetch_array($result);

$result2 = mysql_query("SELECT * FROM room
	WHERE Id = $row[room_id]");
$row2 = mysql_fetch_array($result2);

switch ($row2['building_id'])
		{
		case 1:
		  $building = "逸夫楼";
		  break;
		case 2:
		  $building = "机电楼";
		  break;
		case 3:
		  $building = "高工楼";
		  break;
		default:
		  $building = "冶金楼";
		}

$message = "您申请预约的".$row['order_date']."，".$row['order_time_start']."~".$row['order_time_end']."，" .$building.$row2['room_name']."已经通过审核。";

$now = date("Y-m-d/h:i:sa");

mysql_query( "INSERT INTO msg (user_id,msg,send_time) VALUES ('$row[user_id]', '$message','$now') ");



mysql_close($con);
echo "<script>location='admin.php'</script>";


?>