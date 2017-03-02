<?php
session_start();
$Id=$_SESSION['Id'];
$psd=$_GET['psd'];  

include_once('connect.php');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
 }

mysql_select_db("reserve", $con);

mysql_query("UPDATE admin SET password = $psd
WHERE Id = $Id");

mysql_close($con);
echo "<script>location='index.php'</script>";


?>