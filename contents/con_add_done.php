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

$message=$_POST['message'];
$pro_code=$_POST['pro_code'];

$_SESSION['score']=$_SESSION['score']+5;
//$score=$_SESSION['score'];

$message=htmlspecialchars($message);


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO posts (message,company_id,member_name,created) VALUES(?,?,?,NOW())';
$stmt= $dbh->prepare($sql);
$data[]=$message;
$data[]=$pro_code;
$data[]=$_SESSION['member_name'];
$stmt->execute($data);


//アップデートされない　書き方に問題化？　もういぢ度書く昼用があるのか？　idのせいのようだ
$sql_2='UPDATE mst_member SET score=? WHERE name=?';
$stmt_2= $dbh->prepare($sql_2);
$data_2[]=$_SESSION['score'];
$data_2[]=$_SESSION['member_name'];

$stmt_2->execute($data_2);

//うまく動作しない


//エグゼキュートの下にアップデート

$dbh = null;

print $message;
print'を追加しました<br/>';


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();
}
?>

<a href="con_product.php?procode=<?php print $pro_code; ?>&&page=1">戻る</a>

</body>
</html>
















