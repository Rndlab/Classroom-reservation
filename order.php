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
		.date{width:80px;}
	</style>

  <title>预约</title>

  <?php 
	if(!isset($_GET["id"]))
	{
		echo "<script>window.location.href='index.php'</script>";
	}
	else 
	echo "<script>var classroom= '$_GET[id]' </script>";
  ?>
 </head>

 <body>
 			<div class="navbar navbar-default">
				<h1>
					&nbsp;&nbsp;预约
					<a>
					<?php
						include_once('connect.php');
						mysql_select_db("reserve", $con);
						 if(isset($_SESSION['Id']))
						 {
						 $result = mysql_query("SELECT * FROM admin WHERE Id='$_SESSION[Id]' limit 1");
						 $row = mysql_fetch_array($result);
						 echo "<span class='username'>$row[username]<span>";
						 echo "<img class='headpic' src='img/$row[picurl]'>";
						 }
					?>
					</a>
				</h1>
			</div>

	<div class="container">
	<label>教室编号：<?php echo"$_GET[id]" ?></label>
	
	<table class="table table-striped table-bordered table-hover">
	<label>该教室的已有预约</label>
	<thead>
      <tr>
         <th>预约日期</th>
         <th>开始时间</th>
         <th>结束时间</th>
		 <th>活动说明</th>
      </tr>
   </thead>
   <tbody>
	<?php
	include_once('connect.php');
	mysql_select_db("reserve", $con);
	$result = mysql_query("SELECT * FROM room_order 
	WHERE room_id='$_GET[id]' and review='1'");
	while($row = mysql_fetch_array($result))
	{

		echo "<tr>
		<td>$row[order_date]</td>
		<td>$row[order_time_start]</td>
		<td>$row[order_time_end]</td>
		<td>$row[useage]</td>
		</tr>";
	}
	mysql_close($con);
	?>
	   </tbody>
	</table>

		<div class="btn-group">	
		<label>起始时间</label>
				 <button class="btn" id="startime" data-toggle="tooltip"  title="开始时间要早于结束时间哦。" >8:00</button> 
				 <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li>
						<a onclick="getstart(8,0)">8:00</a>
					</li>
					<li>
						<a onclick="getstart(9,0)">9:55</a>
					</li>
					<li>
						<a onclick="getstart(13,0)">13:30</a>
					</li>
					<li>
						<a onclick="getstart(15,0)">15:20</a>
					</li>
					<li>
						<a onclick="getstart(17,0)">17:10</a>
					</li>
					<li>
						<a onclick="getstart(19,0)">19:30</a>
					</li>
				</ul>
			</div>

		<span class="glyphicon glyphicon-arrow"></span>
		<div class="btn-group">	
		<label>结束时间</label>
				 <button class="btn" id="endtime">9:35</button> <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li>
						<a onclick="getstart(9,1)">9:35</a>
					</li>
					<li>
						<a onclick="getstart(11,1)">11:30</a>
					</li>
					<li>
						<a onclick="getstart(15,1)">15:05</a>
					</li>
					<li>
						<a onclick="getstart(16,1)">16:55</a>
					</li>
					<li>
						<a onclick="getstart(18,1)">18:45</a>
					</li>
					<li>
						<a onclick="getstart(21,1)">21:05</a>
					</li>
				</ul>
			</div>


		<form enctype="multipart/form-data"  role="form" class="form-horizontal">
		<br>
		日期<br>
		<input type="text" id="year" class="date" maxlength=4 onkeyup='this.value=this.value.replace(/\D/gi,"")' value="<?php echo date('Y'); ?>"/>年
		<input type="text" id="month" class="date" maxlength=2 onkeyup='this.value=this.value.replace(/\D/gi,"")'
		value="<?php echo date('m'); ?>"/>月
		<input type="text" id="day" class="date" maxlength=2 onkeyup='this.value=this.value.replace(/\D/gi,"")'
		value="<?php echo date('d'); ?>"/>日
		<br><br>
		手机号码<input type="text" id="phone" maxlength=11 onkeyup='this.value=this.value.replace(/\D/gi,"")' class="form-control"/>
		<br><br>
		
		<label for="name">预约用途</label>
		<textarea class="form-control" rows="3" id="usage"></textarea>
		<br/><br/>
		<button class="btn btn-xs btn-success"  onclick="sub()">提交预约</button>

		</form>

	</div>
	

<script>
var startime=8;
var endtime=9;

var start = document.getElementById("startime");
var end = document.getElementById("endtime");
var year = document.getElementById("year");
var month = document.getElementById("month");
var day = document.getElementById("day");
var phone = document.getElementById("phone");
var usage = document.getElementById("usage");

function sub()
{
	window.location.href="sendorder.php?start="+start.innerHTML+"&end="+end.innerHTML+"&year="+year.value+"&month="+month.value+"&day="+day.value+"&phone="+phone.value+"&usage="+usage.value+"&classroom="+ classroom;
	window.event.returnValue=false;
}

function getstart(time,type)
{

		if (type && time>startime)
		{
			endtime=time;
			switch (time)
		   {
		   case 9:
			 end.innerHTML = "9:35";
			 break;
		   case 11:
			 end.innerHTML = "11:30";
			 break;
		   case 15:
			 end.innerHTML = "15:05";
			 break;
		   case 16:
			 end.innerHTML = "16:55";
			 break;
		   case 18:
			 end.innerHTML = "18:45";
			 break;
		   default:
			 end.innerHTML = "21:05";
			}
			
		}
		
		else if (!type && time< endtime)
		{
			startime  = time;
			switch (time)
		   {
		   case 8:
			 start.innerHTML = "8:00";
			 break;
		   case 9:
			 start.innerHTML = "9:55";
			 break;
		   case 13:
			 start.innerHTML = "13:30";
			 break;
		   case 15:
			 start.innerHTML = "15:20";
			 break;
		   case 17:
			 start.innerHTML = "17:10";
			 break;
		   default:
			 start.innerHTML = "19:30";
			}
			
		}
		else
		{
			
			$('#startime').tooltip('show');	
			setInterval("$('#startime').tooltip('destroy')",2000)
		}

}

</script>
 </body>
</html>
