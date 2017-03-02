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
	.username{margin:0 10px 10px 10px;float:right;font-size:20px;color:#ffffff;}
</style>

  <title>USTB教室预约系统</title>
 </head>
 <body>
 	<div class="navbar">
		<h1>
			&nbsp;&nbsp;我的预约
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
				<li>
					<a href="index.php">首页</a>
				</li>
				<li class="active">
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

		<div class="col-md-10">

			<table class="table table-striped table-bordered table-hover">
	<label>我的预约</label>
	<thead>
      <tr>
		 <th>教学楼</th>
		 <th>教室</th>
		 <th>类型</th>
         <th>预约日期</th>
         <th>开始时间</th>
         <th>结束时间</th>
		 <th>活动说明</th>
		 <th>审核状态</th>
		 <th>操作</th>
      </tr>
   </thead>
   <tbody>
	<?php
	include_once('connect.php');
	mysql_select_db("reserve", $con);
	$result = mysql_query("SELECT * FROM room_order 
	WHERE user_id='$_SESSION[Id]'");
	while($row = mysql_fetch_array($result))
	{
		$result2 = mysql_query("SELECT * FROM room WHERE Id='$row[room_id]'");
		$rowa = mysql_fetch_array($result2);

		if ($rowa['room_type'] == 1)
			$type = "教室";
		else
			$type = "会议室";
		
		if ($row['review'] == 1)
			$review = "通过";
		else
			$review = "待审核";
		

		switch ($rowa['building_id'])
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

		echo "<tr>
		<td>$building</td>
		<td>$rowa[room_name]</td>
		<td>$type</td>
		<td>$row[order_date]</td>
		<td>$row[order_time_start]</td>
		<td>$row[order_time_end]</td>
		<td>$row[useage]</td>
		<td>$review</td>
		
		<td>
		<button class='btn btn-xs btn-danger' style='color:#ffffff;' onclick='dele($row[Id])'><i class='glyphicon glyphicon-remove'></i>&nbsp;取消</button>
		</td>


		</tr>";
	}

	?>
	</tbody>
	</table>
	
	<table class="table table-striped table-bordered table-hover">
	<label>我的收藏</label>
	   <thead>
      <tr>
         <th>#</th>
         <th>教室名</th>
         <th>教学楼</th>
		 <th>所在楼层</th>
		 <th>教室类别</th>
		 <th>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</th>
		 <th>是否可用</th>
		 <th>操&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作</th>
      </tr>
   </thead>
   <tbody>
	<?php
	$result1 = mysql_query("SELECT * FROM favor WHERE user_id='$_SESSION[Id]'");
	while($row1 = mysql_fetch_array($result1))
	{
		$result2 = mysql_query("SELECT * FROM room WHERE Id='$row1[room_id]'");
		$row2 = mysql_fetch_array($result2);
		
		if ( $row2['room_type'] == 1)
			$type = "教室";
		else
			$type = "会议室";
		
		if ( $row2['avail'] == 1)
			$avail = "可用";
		else
			$avail = "不可用";

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

		echo "

		<tr>
		<td>$row2[Id]</td>
		<td>$row2[room_name]</td>
		<td>$building</td>
		<td>$row2[floor]</td>
		<td>$type</td>
		<td>$row2[remark]</td>
		<td>$avail</td>

		<td>
		<button class='btn btn-xs btn-success' style='color:#ffffff;' onclick='order($row2[Id])'><i class='glyphicon glyphicon-check'></i>&nbsp;预约</button>
        <button class='btn btn-xs btn-danger' style='color:#ffffff;' onclick='unfav($row2[Id])'><i class='glyphicon 
		glyphicon-star'></i>&nbsp;取消收藏</button>
		</td>
		</tr>";
	}
	
	?>
	
   </tbody>
</table>


</div>
	<script type="text/javascript">

		function dele(id)
		{
			window.location.href="delorder.php?id=" + id;
			window.event.returnValue=false;
		}
		function order(id)
		{
			window.location.href="order.php?id=" + id;
			window.event.returnValue=false;
		}
		function unfav(id)
		{
			window.location.href="unfavor.php?id=" + id;
			window.event.returnValue=false;
		}
	</script>
 </body>
</html>