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
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

$reply=$_POST['reply'];
$post_id=$_POST['id'];
$question=htmlspecialchars($reply);

if($question=='')
{
	print'返信内容を入力してください<br/>';
	print'<a href="post.php?id='.$post_id.'">';
    print'戻る';
}
else
{
	print'質問内容<br/>';
	print$reply;
	print'</br>';


	print'<form method="post" action="message_reply_add_check_done.php">';
	print'<input type="hidden" name="reply" value="'.$reply.'">';
	print'<br/>';
	print'<input type="hidden" name="id" value="'.$post_id.'">';
	print'<br/>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="OK">';
	print'</form>';





}



?>

</body>
</html>