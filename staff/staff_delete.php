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
$staff_code=$_GET['staffcode'];

//接続
$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT name FROM mst_staff WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$staff_code;
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$staff_name=$rec['name'];

//接続を切る
$dbh=null;

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>

スタッフ削除<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code; ?>
<br/>
スタッフ名<br/>
<?php print $staff_name; ?>
<br/>
このスタッフを削除してもよろしいですか?<br/>
<br/>

<form method="post" action="staff_delete_done.php">
<input type="hidden" name="code" value="<?php print $staff_code; ?>">

<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
