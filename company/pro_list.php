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

try
{

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT code,name FROM mst_company WHERE 1';//mst_staffテーブルのnameフィールドの値を全て取り出す
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print'企業一覧<br/><br/>';

print'<form method="post" action="pro_branch.php">';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)//これがないと止まらなくなる。ループし続ける
	{
		break;
	}
	print'<input type="radio" name="procode" value="'.$rec['code'].'">';
	print $rec['name'];
	print'<br/>';
}
print'<input type="submit" name="disp" value="参照">';
print'<input type="submit" name="add" value="追加">';
print'<input type="submit" name="edit" value="修正">';
print'<input type="submit" name="delete" value="削除">';
print'</form>';


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしています';
	exit();
}

?>
<a href="../staff_login/staff_top.php">トップメニューへ</a><br/>

</body>
</html>