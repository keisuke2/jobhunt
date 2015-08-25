<?php
if(isset($_COOKIE['email'])){
	$member_email=$_COOKIE['email'];

}else{
	$member_email='';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<h4>■　会員ログイン</h4><br/>
<form method="post" action="member_login_check.php">
ID (メールアドレス)<br/>
<input type="text" name="email" value="<?php echo $member_email; ?>"><br/>
パスワード<br/>
<input type="password" name="pass"><br/>
<br/>

<input type="checkbox" name="save" id="save" value="on">IDを保存する<br/>
<input type="submit"value="ログイン"><br/>
<br/>
<a href="member_add.php">会員登録</a>
</form>
</body>
</html>