<?php  
session_start();

$Id=$_POST['Id'];  
$password=$_POST['password']; 


if($Id == "")  
{  
  
    echo "请填写用户名<br>";  
     echo"<script type='text/javascript'>alert('请填写用户名');location='login.html';  
            </script>";  
}  
elseif($password == "")  
{  
    echo"<script type='text/javascript'>alert('请填写密码');location='login.html';</script>";  
      
}  
else  
{   

	 
	$db = mysql_connect("localhost","root","113113")   
		or die("连接数据库失败！");  
	  
	mysql_select_db("reserve")  
		or die ("不能连接到user".mysql_error()); 

	$check_query = mysql_query("SELECT * FROM admin 
	WHERE Id='$Id' and password='$password'  limit 1"); 
	$result = mysql_fetch_array($check_query);  

	
     if($result)
	{$_SESSION["Id"]=$Id;
		 echo"<script type='text/javascript'>location='index.php';</script>"; }     
     else  
		 echo"<script type='text/javascript'>alert('密码错误');location='login.html';</script>";  
}  
?>  