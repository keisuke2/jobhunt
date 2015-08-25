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

try
{


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT message FROM posts WHERE member_name=?';
$stmt=$dbh->prepare($sql);
$data[]=$_SESSION['member_name'];
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$message=$rec['message'];
//$answer_name=$rec['member_name'];

//接続を切る
$dbh=null;

print'<h3>';
print $_SESSION['member_name'];
print'さんの投稿内容';
print'</h3>';
print'<br/>';
print'・';
print $message;
print'<br/>';
print'</td>';
print'</tr>';
print'</table>';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}


?>




<h3>◾️　質問内容<h3>


<?php
try{



$question_id=$_GET['id'];

$pro_code=$_GET['procode'];

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT question,member_name_q FROM question WHERE id=?';
$stmt=$dbh->prepare($sql);
$data_2[]=$question_id;
$stmt->execute($data_2);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$question=$rec['question'];
$answer_name=$rec['member_name_q'];

//接続を切る
$dbh=null;

print'<table border="1">';
print'<tr>';
print'<td>';
print $answer_name;
print'さんの質問内容';
print'<br/>';
print'・';
print $question;
print'<br/>';
print'</td>';
print'</tr>';
print'</table>';



}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>


<?php

$pro_code=$_GET['procode'];

print'<form method="post" action="message_reply_add.php" enctype="multipart/form-data">';
print'<br/>';
print'質問内容に答えて上げてください。';
print'<br/>';
//print'<input type="text" name="message" style="width:500px" >';
print'<textarea name="answer" cols="100" rows="10" ></textarea>';
print'<br/>';
print'<br/>';
print '<input type="hidden" name="question_id" value="'.$question_id.'">';
print '<input type="hidden" name="procode" value="'.$pro_code.'">';
print'<input type="submit" style="width:100px" value="返信"　>';
print'<br/>';
print'</form>';



?>





<form method="post" action="con_product.php">
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>



</body>
</html>