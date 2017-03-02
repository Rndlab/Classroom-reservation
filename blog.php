<?php
header("Content-type: text/html; charset=utf-8");
  

if ((($_FILES["file"]["type"] == "image/gif") 
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2*1024*1024))    //类型、大小限制
  {
	if ($_FILES["file"]["error"] > 0)
	{echo "Error: " . $_FILES["file"]["error"] . "<br />";}
	else
    {
		if (file_exists("upload/" . $_FILES["file"]["name"]))
			{echo $_FILES["file"]["name"] . " already exists. ";}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"img/" . $_FILES["file"]["name"]);
			echo "图片上传成功";
		}	
	}
  }
else
  {echo "这不是图片哦";}
$day = date("Y-m-d h:i:sa");
$picname = $_FILES["file"]["name"];
$con = mysql_connect("localhost","root","113113");


mysql_select_db("reserve", $con);


$sql="INSERT INTO admin (Id,username,password,email,picurl)
VALUES
('$_POST[Id]', '$_POST[username]', '$_POST[password]', '$_POST[email]','$picname')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "注册成功";
mysql_close($con);


?>

