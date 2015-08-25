<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['member_login'])==false)
{
	print'ようこそゲスト様';
	print'<a href="member_login.php">会員ログイン</a><br/>';
	print'<br/>';
}
else
{
	print'ようこそゲスト様';
	print $_SESSION['member_name'];
	print'様';
	print'<a href="member_logput.php">ログアウト</a><br/>';
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


while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)//これがないと止まらなくなる。ループし続ける
	{
		break;
	}

	print'<a href="con_product.php?procode='.$rec['code'].'">';
	print $rec['name'];
	print'</a>;';
	print'<br/>';
}


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしています';
	exit();
}

?>

</body>
</html>