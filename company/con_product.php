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
掲示板<br/>
<br/>
<form method="post" action="twitter_add_check.php" enctype="multipart/form-data">
なんでもいいから投稿してください。<br/>
<input type="text" name="message" style="width:500px"><br/>

<br/>

<input type="submit" style="width:100px" value="確認"　><br/>
</form>
<?php

try
{

$dsn='mysql:dbname=mini_bbs;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT message FROM posts WHERE 1';
$stmt= $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

print '投稿一覧<br/><br/>';
//print '<form method="post" action="pro_branch.php">';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	//print '<input type="radio" name="procode" value="'.$rec['code'].'">';
	//print $rec['name'].'___';

	print $rec['message'].'';
	print'</br>';
}

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();

}


?>

<br/>
<a href="member_logout.php">ロウアウト</a><br/>


</body>
</html>