<?php


session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print'ログインされていません。<br/>';
	print'<a href="../member_login/member_login.html">ログイン画面へ</a>';
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
	//チェックボックスのコードデータを持ってくる
$pro_code=$_GET['procode'];

//接続
$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT name FROM mst_company WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$pro_name=$rec['name'];


//接続を切る
$dbh=null;

}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>

企業コード:<br/>
<?php print $pro_code; ?>
<br/>
企業名:<br/>
<?php print $pro_name; ?>

掲示板<br/>
<br/>

<h2>■　面接内容を投稿しポイントを獲得！他社の面接情報を参照しよう！</h2>



<?php

print'<form method="post" action="con_add_check.php" enctype="multipart/form-data">';
print'<br/>';
print'面接で聞かれた内容を投稿してください。';
print'<br/>';
print'<input type="text" name="message" style="width:500px">';
print'<br/>';
print'<br/>';
print '<input type="hidden" name="pro_code" value="'.$pro_code.'">';
print'<input type="submit" style="width:100px" value="確認"　>';
print'<br/>';
print'</form>';

?>

<h4>■　投稿一覧：</h4><br/>


<?php
//多分企業名とコンテンツを統合して表示させるSQL文が必要となる
try
{

$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
//企業名とテーブル情報を組み合わせる記述が必要
$sql='SELECT id,message,company_id,member_name FROM posts WHERE 1';

$stmt= $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

//print '<form method="post" action="pro_branch.php">';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	
    /*
    print'<td>';
    print $rec['company_id'];
	print $rec['message'];
	print'</td></br>';
	*/
	if($pro_code==$rec['company_id'])
	{	
		


		$rec_id=$rec['id'];
		$rec_message=$rec['message'];
		$rec_member_name=$rec['member_name'];
		?>

		<form method="get" action="post.php">

		<input type="hidden" name="id" value="'.$id.'">
		<input type="submit" value="<?php print $rec_message;print'__'; print $rec_member_name; ?>">
		</form>

	 <?php
		


	    
	}


}

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();

}


?>

</body>
</html>

<br/>
<form>
<input type="button" onclick="history.back()" value="戻る">

</form>
<a href="../member_login/member_logout.php">ポイント参照</a><br/>
<br/>
<a href="../member_login/index.php">TOPへ戻る</a><br/>
<br/>
<a href="../member_login/member_logout.php">ログアウト</a><br/>


</body>
</html>