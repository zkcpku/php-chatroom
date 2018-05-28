<?php
session_start();
$_SESSION['username'] = '';
if(!empty($_POST))
{
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	require  'sqlconnect.php';
	$sql = "SELECT * FROM `user` WHERE username = '$username' ";
	$result = mysqli_query($mysqli,$sql);
	$r = mysqli_fetch_assoc($result);
	if(empty($r))
	{
		echo "<script>alert('用户不存在')</script>";
	}
	else
	{
		require 'sqlconnect.php';
		$sql1 = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";
		$result1 = mysqli_query($mysqli,$sql1);
		$r1 = mysqli_fetch_assoc($result1);
		if(empty($r1))
		{
			echo "<script>alert('密码错误')</script>";
		}
		else
		{
			$_SESSION['username'] = $r1['username'];
			echo "<script>alert('登陆成功，即将跳转');window.location.href = 'chat.php'</script>";
		}
	}
}

include ('signin.html');