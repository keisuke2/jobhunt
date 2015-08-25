<?php



session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print'ログインされていません。<br/>';
	print'<a href="../member_login/member_login.php">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['member_name'];
	print'さんログイン中<br/>';
	print'<br/>';
}

?>

<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP基礎</title>
</head>
<body>
	<?php

	$message=$_POST['message'];
	$pro_code=$_POST['pro_code'];



	$message=htmlspecialchars($message);



	if($message=='')
	{
		print'面接内容が入力されてません<br/>';
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
	}
	/*
	else if($message<100)
	{
		print '100文字以上で入力してください';
		print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
	}
	*/
	else
	{
		print'面接内容:';
		print $message;
		print '<br/>';
        print'上記の内容を追加します<be/>';
        print'<form method="post" action="con_add_done.php">';
        //print'<input type="hidden" name="name" value="'.$pro_name.'">';
        print'<input type="hidden" name="message" value="'.$message.'">';
        print'<br/>';
        print'<input type="hidden" name="pro_code" value="'.$pro_code.'">';
        print'<br/>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
	}

	?>
</body>
</html>