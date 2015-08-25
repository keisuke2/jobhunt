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

$company_name=$_POST['company_name'];
$url=$_POST['url'];

$company_name=htmlspecialchars($company_name);
$url=htmlspecialchars($url);

$dsn='mysql:dbname=jobhunt; host=localhost';
$user='root';
$password='root';
$dbh = new PDO($dsn,$user,$password) ;
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_company(name,url) VALUES(?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$company_name;
$data[]=$url;
$stmt->execute($data);

$dbh=null;

print '企業名:';
print $company_name;
print '<br/>';
print'URL:';
print $url;
print'<br/>';
print'を追加しました<br/>';






}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております。' ;
	exit();

}


?>
<a href="../member_login/search_top.php">戻る</a>;
</body>
</html>