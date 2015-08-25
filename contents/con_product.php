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

<h2>　面接内容を投稿しポイントを獲得！他社の面接情報を参照しよう！</h2>



<?php

print'<form method="post" action="con_add_check.php" enctype="multipart/form-data">';
print'<br/>';
print'<h4>■　面接で聞かれた内容を投稿してください。</h4>';
print'<br/>';
print'投稿すると４ポイント付与されます！';
print'(例)　1次面接　学生時代頑張ったことは？　動物に例えると？.....';
print'<br/>';
//print'<input type="text" name="message" style="width:500px" >';
print'<textarea name="message" cols="100" rows="10" ></textarea>';
print'<br/>';
print'<br/>';
print '<input type="hidden" name="pro_code" value="'.$pro_code.'">';
print'<input type="submit" style="width:100px" value="確認"　>';
print'<br/>';
print'</form>';

?>

<h4>■　投稿一覧：</h4>
<h5>* 気になる投稿をクリックすると投稿者に質問できます。</h5>










<?php
//多分企業名とコンテンツを統合して表示させるSQL文が必要となる
try
{


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

//既読かどうかを表示させるための

// $sql_2='SELECT id FROM company_member_record WHERE company_id=?,member_id=?';
$sql_2='SELECT id FROM company_member_record WHERE company_id=? AND member_id=?';
$stmt_2=$dbh->prepare($sql_2);
$data_2[]=$pro_code;
$data_2[]=$_SESSION['code'];
$stmt_2->execute($data_2);
//取り出す
$rec_2=$stmt_2->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する



$sql='SELECT id,message,member_name,created,code FROM posts, mst_company  WHERE posts.company_id=mst_company.code ORDER BY id DESC LIMIT '.$start.',10';

$stmt= $dbh->prepare($sql);
$stmt->execute();

$dbh = null;


if($rec_2['id']==''){
	print'<h3>';
	print '投稿内容をみるためには4ポイントが必要です。よろしいですか？';
	print'</h3>';
	print'<form method="post" action="record_check_done.php">';
	print'<input type="hidden" name="procode" value="'.$pro_code.'">';
	print'<br/>';
	print'<input type="submit" value="OK">';
	print'</form>';


}
else
{




//print '<form method="post" action="pro_branch.php">';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	
   
	
	if($pro_code==$rec['code'])
	{
		
		print'<table border="1">';
		print'<tr>';
		print'<td>';
		print'<a href="../contents/post.php?id='.$rec['id'].'&& code='.$rec['code'].'">';
		print'・投稿日時： ';
		print $rec['created'];
		print '<br/>';
		print'・投稿内容 : ';
		print $rec['message'];
	    print'___【';
	    print $rec['member_name'];
	    print '】さん';
	    print'<br/>';
	    print'</td>';
	    print'</tr>';
	    print'</table>';

	}



}


/*
print'<ul class="paging">';
print'<li><a href="con_product.php?page=<?php print($page-1);?>&&procode=<?php print　$pro_code;?>">前のページへ</a></li>';
print'<li><a href="con_product.php?page=<?php print($page+1);?>&&procode=<?php print　$pro_code;?>" >次のページへ</a></li>';
*/
print'<ul class="paging">';
print'<li><a href="con_product.php?page='.($page-1).' &&procode='.$pro_code.'">前のページへ</a></li>';
print'<li><a href="con_product.php?page='.($page+1).' &&procode='.$pro_code.'">次のページへ</a></li>';

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

<a href="../message/message.php?page=1&&page_2=1&&procode=<?php print$pro_code ;?>">■　メッセージBOX</a><br/>
<br/>
<a href="../member_login/index.php">■　TOPへ戻る</a><br/>
<br/>
<a href="../member_login/member_logout.php">■　ログアウト</a><br/>


</body>
</html>