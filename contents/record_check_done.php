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

$_SESSION['score']=$_SESSION['score']-4;


	//チェックボックスのコードデータを持ってくる
$pro_code=$_POST['procode'];

if($_SESSION['score']<=0){
	print'面接内容を投稿してください';
}
else
{

//接続
$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO company_member_record (company_id,member_id) VALUES(?,?)';
$stmt= $dbh->prepare($sql);
$data[]=$pro_code;
$data[]=$_SESSION['code'];
$stmt->execute($data);




$sql_2='UPDATE mst_member SET score=? WHERE name=?';
$stmt_2= $dbh->prepare($sql_2);
$data_2[]=$_SESSION['score'];
$data_2[]=$_SESSION['member_name'];

$stmt_2->execute($data_2);

//接続を切る
$dbh=null;



print'ありがとうございます';
print'企業情報を確認できるようになりました。';
}

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>
<a href="con_product.php?procode=<?php print $pro_code; ?>&&page=1"><br/>
戻る</a>

</body>
</html>