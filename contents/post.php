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


<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP基礎</title>
</head>
<body>

<h2>■　投稿者に聞きたいことを質問してください。</h2><br/>
<br/>
<h4>
*　
質問するには2ポイント必要です。他社の面接状況を投稿してポイントを手に入れてください。<br/>
回答者は質問に答えることで3ポイント貯まります。<br/>
<br/>
</h4>


<?php
try
{


$post_id=$_GET['id'];
$con_code=$_GET['code'];


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//入力されたコードの名前をテーブルから選ぶ
$sql='SELECT message,member_name FROM posts WHERE id=?';
$stmt=$dbh->prepare($sql);
$data[]=$post_id;
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$message=$rec['message'];
$answer_name=$rec['member_name'];

//接続を切る
$dbh=null;

if($answer_name==$_SESSION['member_name'])
{
	print'自分の投稿に対して質問する事は出来ません';
}
else{



print $message;
print'___';
print'投稿者 :';
print $answer_name;



print'<form method="post" action="post_check.php" enctype="multipart/form-data">';
print'<br/>';
print'質問を入力してください。';
print'<br/>';
print'<input type="text" name="question" style="width:500px">';
print'<br/>';
print'<input type="hidden" name="id" value="'.$post_id.'">';
print'<input type="hidden" name="code" value="'.$con_code.'">';
print'<br/>';
print'<br/>';
print'<input type="submit" style="width:100px" value="確認"　>';
print'<br/>';
print'</form>';

}

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}


?>
<form method="post" action="con_product.php">
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>



</body>
</html>