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

$question=$_POST['question'];
$post_id=$_POST['id'];
$con_code=$_POST['code'];
if($_SESSION['score']<=0)
{
	print 'ポイントが足りません。面接内容を投稿してください';

}
else
{


$_SESSION['score']=$_SESSION['score']-2;
$question=htmlspecialchars($question);


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO question (question,post_id,member_name_q) VALUES(?,?,?)';
$stmt= $dbh->prepare($sql);

$data[]=$question;
$data[]=$post_id;
$data[]=$_SESSION['member_name'];
$stmt->execute($data);

$sql_2='UPDATE mst_member SET score=? WHERE name=?';
$stmt_2= $dbh->prepare($sql_2);
$data_2[]=$_SESSION['score'];
$data_2[]=$_SESSION['member_name'];

$stmt_2->execute($data_2);

$dbh = null;

print $question;
print'を送信しました<br/>';
//print $pro_code;
}

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();
}

?>
<br/>

<a href="con_product.php?procode=<?php print $con_code; ?>&&page=1">戻る</a>
</body>
</html>