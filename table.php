<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="bootstrap\css\bootstrap-combined.min.css" rel="stylesheet" media="screen">

<script type="text/javascript" src="js\jquery-ui.js"></script>
<script type="text/javascript" src="js\jquery-2.0.0.min.js"></script>

<link href="bootstrap\css\bootstrap.css" rel="stylesheet" media="screen">

<script type="text/javascript" src="bootstrap\js\bootstrap.min.js"></script>

<style type="text/css">
	*{font-family:'微软雅黑';}
	.table{width:50%;margin-left:auto;margin-right:auto;}
	.navbar{background-color:#5ed270;color:#ffffff;}
</style>


</head>
<body>
			<div class="navbar navbar-default">
				<h1>
					&nbsp;&nbsp;教室列表
				</h1>
			</div>
<table class="table table-striped table-bordered table-hover">
   <thead>
      <tr>
         <th>#</th>
         <th>教室名</th>
         <th>教学楼</th>
		 <th>所在楼层</th>
		 <th>教室类别</th>
		 <th>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</th>
		 <th>操&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作</th>
      </tr>
   </thead>
   <tbody>

	<?php
	$con = mysql_connect("localhost","root","113113");
	mysql_select_db("reserve", $con);
	$result = mysql_query("SELECT * FROM room");

	while($row = mysql_fetch_array($result))
	{
		if ( $row['room_type'] == 1)
			$type = "教室";
		else
			$type = "会议室";
		
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

		<td>
		<button class='btn btn-xs btn-default'><i class='icon-pencil'></i></button>
        <button class='btn btn-xs btn-danger'><i class='icon-remove'></i></button>
		</td>
		</tr>";
	}
	
	?>
	
	</tr>
   </tbody>
</table>

</body>
</html>