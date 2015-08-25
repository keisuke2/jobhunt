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

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');




$sql='SELECT code,name FROM mst_company WHERE name=?';
$stmt=$dbh->prepare($sql);
$data[]=$company_name;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	print'企業情報がありません<br/>';
	print'<a href="search_top.php">戻る</a>';
	print'<br/>';
	print'新しく企業を追加する<br/>';
	print'<a href="../contents/company_add.html">追加する</a>';

}
else
{
    
    $rec_code=$rec['code'];
    $rec_name=$rec['name'];

    ?>

	<a href="../contents/con_product.php?procode=<?php print $rec_code ;?>&&page=1"><?php print $rec_name;?></a>
   
<?php
    
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