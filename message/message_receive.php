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



$answer_id=$_GET['id'];

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//$sql_2='SELECT a.id, a.answer, a.member_name FROM answer AS a INNER JOIN question q ON a.question_id = q.id WHERE a.member_name = ? ORDER BY id DESC ';
//入力されたコードの名前をテーブルから選ぶ
$sql_2='SELECT q.question,q.member_name_q,a.answer FROM answer as a INNER JOIN question q ON (a.question_id = q.id) WHERE a.id = ?';
//$sql_2='SELECT q.question,q.member_name_q,answer.answer FROM answer AS INNER JOIN question q ON answer.question_id = q.id WHERE q.id = ? ' ;
//$sql='SELECT question,member_name_q FROM question WHERE id=?';
$stmt2=$dbh->prepare($sql_2);
$data_2[]=$answer_id;
$stmt2->execute($data_2);
//取り出す
$rec=$stmt2->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
//var_dump ($rec);
$question=$rec['question'];
$answer_name=$rec['member_name_q'];
$answer=$rec['answer'];

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
print '<br/>';



}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>


<?php

$question_id=$_GET['id'];

print'<h3>返信内容</h3>';
print'<br/>';
print'<table border="1">';
print'<tr>';
print'<td>';
print $answer;
print'</td>';
print'</tr>';
print'</table>';
//print'</form>';



?>





<form method="post" action="con_product.php">
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>



</body>
</html>