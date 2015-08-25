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
<h3>ポイント <?php print $_SESSION['score']; ?>点</h3><br/>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<h2>■　メッセージBOX</h2>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP基礎</title>
</head>
<body>
<h3>・投稿に対する質問一覧</h3>
<br/>
質問に対して返信すると３ポイント付与されます。

<?php


try
{

	$pro_code=$_GET['procode'];
	$page = $_GET['page'];
if($page == ''){//前の画面Pra.phpで'input type="hidden'でpageをindex.phpで送信したらエラーが出なくなった
	$page = 1;
}

$page =max($page,1);

$start = ($page - 1)*5;





$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//$sql='SELECT id,message,member_name FROM posts WHERE 1';

$sql='SELECT q.id, q.question, q.member_name_q FROM question AS q INNER JOIN posts p ON q.post_id = p.id WHERE p.member_name = ? ORDER BY id DESC LIMIT '.$start.',5';
$data[]=$_SESSION['member_name'];
$stmt= $dbh->prepare($sql);
$stmt->execute($data);

$dbh = null;

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}


	print'<table border="1">';
    print'<tr>';
	print'<td>';
	print'・';
	print '<a href="message_reply.php?id='.$rec['id'].'&& procode='.$pro_code.'">';
	//print $rec['message'].'___';
	print $rec['question'].'___';
	//print $rec['member_name'];
	print'FROM   : ';
	print $rec['member_name_q'];
	print'さん';
	print'</a>';
	print'</br>';
	print'</td>';
	print'</tr>';
	print'</table>';

	
}

	print'<br/>';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();

}

?>

<ul class="paging">
<li><a href="message.php?page=<?php print($page-1);?>&&page_2=1&&procode=<?php print$pro_code ;?>">前のページへ</a></li>
<li><a href="message.php?page=<?php print($page+1);?>&&page_2=1&&procode=<?php print$pro_code ;?>" >次のページへ</a></li>
</ul>
<h3>・質問に対する返信一覧</3><br/></h3>
<?php

try
{

$page_2 = $_GET['page_2'];
if($page_2 == ''){//前の画面Pra.phpで'input type="hidden'でpageをindex.phpで送信したらエラーが出なくなった
	$page_2 = 1;
}

$page_2 =max($page_2,1);

$start_2 = ($page_2 - 1)*5;


$dsn='mysql:dbname=jobhunt;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//$sql='SELECT id,message,member_name FROM posts WHERE 1';

$sql_2='SELECT a.id, a.answer, a.member_name FROM answer AS a INNER JOIN question q ON a.question_id = q.id WHERE q.member_name_q = ? ORDER BY id DESC LIMIT '.$start_2.',5 ';
$data_2[]=$_SESSION['member_name'];
$stmt_2= $dbh->prepare($sql_2);
$stmt_2->execute($data_2);

$dbh = null;

while(true)
{
	$rec=$stmt_2->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}


	print'<table border="1">';
    print'<tr>';
	print'<td>';
	print'・';
	print '<a href="message_receive.php?id='.$rec['id'].'">';
	print $rec['answer'].'___';
	//print $rec['member_name'];
	print'FROM   : ';
	print $rec['member_name'];
	print'さん';
	print'</a>';
	print'</br>';
	print'</td>';
	print'</tr>';
	print'</table>';

	
}

	print'<br/>';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();

}

?>

<ul class="paging">
<li><a href="message.php?page_2=<?php print($page_2-1);?>&&page=1&&procode=<?php print$pro_code ;?>">前のページへ</a></li>
<li><a href="message.php?page_2=<?php print($page_2+1);?>&&page=1&&procode=<?php print$pro_code ;?>" >次のページへ</a></li>
</ul>
<br/>
<a href="../contents/con_product.php?procode=<?php print $pro_code; ?>&&page=1">戻る</a>
</body>
</html>
</body>
</html>