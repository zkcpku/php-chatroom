<?php

if(!empty($_POST))
{
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$ip = $_SERVER["REMOTE_ADDR"];
	
	$strip = (string)$ip;
	
	if(strlen($username) >10)
	{
		echo "<script>alert('用户名不能超过10个字符')</script>";
	}
	elseif (strlen($username) < 5) 
	{
		echo "<script>alert('用户名不能少于5个字符')</script>";
	}
	else
	{	
		//登陆数据库
		require 'sqlconnect.php';
		$sql = "SELECT * FROM `user` WHERE IP = '$strip' ";
		$result = mysqli_query($mysqli,$sql);
		$r = mysqli_fetch_assoc($result);
		if (!empty($r)) 
		{
			echo "<script>alert('同一IP仅能注册一次，如有疑问请联系2622321332@qq.com')</script>";
		}
		else
		{
			require 'sqlconnect.php';
			$sql1 = "SELECT * FROM `user` WHERE username = '$username' ";
			$result1 = mysqli_query($mysqli,$sql1);
			$r1 = mysqli_fetch_assoc($result1);
			if(!empty($r1))
			{
				echo "<script>alert('用户名已注册')</script>";
			}
			else
			{
				require 'sqlconnect.php';
				$sql2 = "INSERT INTO user (username,password,IP) VALUES ('$username','$password','$strip')";
				mysqli_query($mysqli,$sql2);
				echo "<script>alert('注册成功')</script>";
				echo "<script language = 'javascript' type = 'text/javascript'>window.location.href = 'index.php'</script>";
			}
		}
	}
}


include ('reg.html');