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
	//チェックボックスのコードデータを持ってくる
$pro_code=$_GET['procode'];

//接続
$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT name,url FROM mst_company WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$pro_name=$rec['name'];
$pro_url=$rec['url'];


//接続を切る
$dbh=null;

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>

企業情報参照<br/>
<br/>
企業コード<br/>
<?php print $pro_code; ?>
<br/>
企業名<br/>
<?php print $pro_name; ?>
<br/>
企業URL<br/>
<?php print $pro_url; ?>
<br/>
<br/>
<form>
<input type="button" onclick="history.back()" value="戻る">

</form>






</body>
</html>