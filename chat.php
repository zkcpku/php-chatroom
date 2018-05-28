<?php
session_start();
if($_SESSION['username'] == '')
{
	echo "<script>alert('请登陆');window.location.href = 'index.php'</script>";
}
else
{
	$username = $_SESSION['username'];
	if(!empty($_POST))
	{
		$content = $_POST['content'];
		$systime = time();//时间戳
		if(strlen($content) ==0)
		{
			echo "<script>alert('不能发送空白信息')</script>";
		}
		else
		{
			require 'sqlconnect.php';
			$sql = "INSERT INTO chat (username,content,systime) VALUES ('$username','$content','$systime')";
			mysqli_query($mysqli,$sql);
			// echo "<script>alert('发送成功')</script>";
		}
	}

	require 'sqlconnect.php';
	$sql1 = "SELECT * FROM `chat` ORDER BY systime ASC";
	$result1 = mysqli_query($mysqli,$sql1);
	$rows = array();
	while($r = mysqli_fetch_assoc($result1))
	{
		if($_SESSION['username'] == $r['username'] )
		{
			$r['is_mine'] = 1;
		}
		else
		{
			$r['is_mine'] = 0;
		}
		$rows[] = $r;
	}

	include ('chat.html');
}