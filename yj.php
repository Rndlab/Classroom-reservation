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
	h1{font-family:'微软雅黑';}
	.navbar{background-color:#5ed270;color:#ffffff;}
	.headpic{height:50px;height:50px;float:right;margin:0 10px 10px 10px;}
	.username{margin:0 10px 10px 10px;float:right;font-size:20px;color:#ffffff;}
</style>
  <title>USTB教室预约系统</title>
 </head>
 <body>
 	<div class="navbar">
		<h1>
			&nbsp;&nbsp;USTB教室预约系统
		
		<a>
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
				<li >
					<a href="index.php">首页</a>
				</li>
				<li>
					<a href="myorder.php">我的预约</a>
				</li>
				<li>
					<a href="admin.php">消息管理</a>
				</li>
				<li>
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
				<li class="active">
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

		<div class="col-md-10">

			<table class="table table-striped table-bordered table-hover">
	<label>教室推荐</label>
   <thead>
      <tr>
         <th>#</th>
         <th>教室名</th>
         <th>教学楼</th>
		 <th>所在楼层</th>
		 <th>教室类别</th>
		 <th>是否可用</th>
		 <th>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</th>
		 <th>操&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作</th>
      </tr>
   </thead>
   <tbody>

	<?php
	include_once('connect.php');
	mysql_select_db("reserve", $con);
	$result = mysql_query("SELECT * FROM room 
	WHERE building_id='4'");
	while($row = mysql_fetch_array($result))
	{
		if ( $row['room_type'] == 1)
			$type = "教室";
		else
			$type = "会议室";
		
		if ( $row['avail'] == 1)
			$avail = "可用";
		else
			$avail = "不可用";

		switch ($row['building_id'])
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

		echo "

		<tr>
		<td>$row[Id]</td>
		<td>$row[room_name]</td>
		<td>$building</td>
		<td>$row[floor]</td>
		<td>$type</td>
		<td>$row[remark]</td>
		<td>$avail</td>

		<td>
		<button class='btn btn-xs btn-success' style='color:#ffffff;' onclick='order($row[Id])'><i class='glyphicon glyphicon-check'></i>&nbsp;预约</button>
        <button class='btn btn-xs btn-warning' style='color:#ffffff;' onclick='fav($row[Id])'><i class='glyphicon 
		glyphicon-star'></i>&nbsp;收藏</button>
		</td>
		</tr>";
	}
	
	?>
	
	</tr>
   </tbody>
</table>
</div>

<script type="text/javascript">
function order(id)
{
	window.location.href="order.php?id=" + id;
	window.event.returnValue=false;
}
function fav(id)
{
	window.location.href="favor.php?id=" + id;
	window.event.returnValue=false;
}
</script>
 </body>
</html>
