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

$question=$_POST['question'];
$post_id=$_POST['id'];
$con_code=$_POST['code'];
$question=htmlspecialchars($question);

if($question=='')
{
	print'質問を入力してください<br/>';
	print'<a href="post.php?id='.$post_id.'">';
    print'戻る';
}
else
{
	print'質問内容<br/>';
	print$question;
	print'</br>';


	print'<form method="post" action="post_check_done.php">';
	print'<input type="hidden" name="question" value="'.$question.'">';
	print'<br/>';
	print'<input type="hidden" name="id" value="'.$post_id.'">';
	print'<input type="hidden" name="code" value="'.$con_code.'">';
	print'<br/>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="OK">';
	print'</form>';





}



?>

</body>
</html>