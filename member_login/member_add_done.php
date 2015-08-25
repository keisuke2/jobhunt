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

$uni_name=$_POST['uni_name'];
$major=$_POST['major'];
$graduate=$_POST['graduate'];
$danjo=$_POST['danjo'];
$member_name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$know=$_POST['know'];

//さにたいず
$score=5;

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_member(uni_name,major,graduate,danjo,name,email,password,know,score) VALUES (?,?,?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$uni_name;
$data[]=$major;
$data[]=$graduate;
$data[]=$danjo;
$data[]=$member_name;
$data[]=$email;
$data[]=$pass;
$data[]=$know;
$data[]=$score;

$stmt->execute($data);

$dbh=null;

print $member_name;
print'さんを追加しました<br/>';



}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしています';
	exit();
}

?>

<a href="member_login.php">ログイン画面へ</a>

</body>
</html>