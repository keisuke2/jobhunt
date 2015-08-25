<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print'ログインされていません。<br/>';
	print'<a href="../member_login/member_login.php">ログイン画面へ</a>';
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<form method="post" action="search.php">
	企業名を入力してください<br/>
	<input type="text" name="company_name"><br/>
	<input type="submit" value="検索">
	<br/>
	<a href="../member_login/member_logout.php">ログアウト</a><br/>
</form>
</body>
</html>