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

$answer=$_POST['answer'];
$question_id=$_POST['question_id'];
$pro_code=$_POST['procode'];


$_SESSION['score']=$_SESSION['score']+4;
$answer=htmlspecialchars($answer);


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO answer (answer,question_id,member_name) VALUES(?,?,?)';
$stmt= $dbh->prepare($sql);

$data[]=$answer;
$data[]=$question_id;
$data[]=$_SESSION['member_name'];

$stmt->execute($data);


$sql_2='UPDATE mst_member SET score=? WHERE name=?';
$stmt_2= $dbh->prepare($sql_2);
$data_2[]=$_SESSION['score'];
$data_2[]=$_SESSION['member_name'];

$stmt_2->execute($data_2);

$dbh = null;

print $answer;
print'を送信しました<br/>';
print'ありがとうございます！';
print'<br/>';
print $pro_code;


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();
}


?>

<a href="../message/message.php?page=1&&page_2=1&&procode=<?php print $pro_code; ?>">戻る</a>
</body>
</html>