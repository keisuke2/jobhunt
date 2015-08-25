<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login'])==false)
{
	print'ログインされていません<br/>';
	print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
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

try
{
$pro_code=$_POST['code'];
$pro_name=$_POST['name'];


$pro_code=htmlspecialchars($pro_code);
$pro_name=htmlspecialchars($pro_name);


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');


$sql='UPDATE mst_company SET name=?WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;

$data[]=$pro_code;
$stmt->execute($data);

$dbh=null;


print'修正しました<br/>';

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしています';
	exit();
}
?>
<a href="pro_list.php">戻る</a>
</body>
</html>