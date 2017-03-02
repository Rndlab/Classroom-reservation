<?php 
session_start();
?>

<!doctype html>
<html lang="en">
 <head>
 <meta charset="utf-8">
<script type="text/javascript" src="js\jquery-ui.js"></script>
<script type="text/javascript" src="js\jquery-2.0.0.min.js"></script>
<link href="bootstrap\css\bootstrap.css" rel="stylesheet" media="screen">
<link href="bootstrap\css\bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="bootstrap\js\bootstrap.js"></script>

<style type="text/css">
	h1{font-family:'Microsoft Yahei';}
	.navbar{background-color:#5ed270;color:#ffffff;}
	.headpic{height:50px;height:50px;float:right;margin:0 10px 10px 10px;}
	.username{margin:0 10px 10px 10px;float:right;font-size:17px;color:#ffffff;}
</style>

  <title>USTB教室预约系统</title>
 </head>
 <body>
 	<div class="navbar">
		<h1>
			&nbsp;&nbsp;USTB教室预约系统
		<a href="admin.php">
		<?php
			include_once('connect.php');
			mysql_select_db("reserve", $con);
			 if(isset($_SESSION['Id']))
			 {
			 $result = mysql_query("SELECT * FROM admin WHERE Id='$_SESSION[Id]' limit 1");
			 $row = mysql_fetch_array($result);
			 
			 echo "<span class='username'>$row[username]<span>";
			 if ($row['adm']) echo "<span class='username'>(admin)<span>";
			 echo "<img class='headpic' src='img/$row[picurl]'>";
			 }
			 else
			{echo"<script type='text/javascript'>location='login.html';</script>";}
		?>
		</a>
		</h1>
	</div>
	

		<div class="col-md-2">
			<ul class="nav nav-list">
				<li class="nav-header">
					功能
				</li>
				<li>
					<a href="index.php">首页</a>
				</li>
				<li>
					<a href="myorder.php">我的预约</a>
				</li>
				<li>
					<a href="admin.php">消息管理</a>
				</li>
				<li class="active">
					<a href="psd.php">密码修改</a>
				</li>
				<li class="nav-header">
					去预约吧
				</li>
				<li>
					<a href="yf.php">逸夫楼</a>
				</li>
				<li>
					<a href="jd.php">机电楼</a>
				</li>
				<li>
					<a href="yj.php">冶金楼</a>
				</li>
				<li>
					<a href="gg.php">高工楼</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="help.html">帮助</a>
				</li>
			</ul>
		</div>

		<div class="col-md-5">

			<form enctype="multipart/form-data"  role="form" class="form-horizontal">
		<br>

		新密码<input type="password" id="newpsd" maxlength=11  class="form-control"/>
		<br><br>
		

		<button class="btn btn-xs btn-success"  onclick="change()">确认更改</button>

		</form>
		</div>

<script type="text/javascript">
var psd = document.getElementById("newpsd");

function change()
{
	window.location.href="newpsd.php?psd=" + psd.value;
	window.event.returnValue=false;
}
</script>
 </body>
</html>
