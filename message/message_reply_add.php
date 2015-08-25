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

<?php



	$answer=$_POST['answer'];
	$question_id=$_POST['question_id'];
	$pro_code=$_POST['procode'];



	$answer=htmlspecialchars($answer);
	
print $question_id;

	if($answer=='')
	{
		print'返信内容が入力されてません<br/>';
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
	}
	else
	{
		print'返信内容:';
		print $answer;
		print '<br/>';
        print'上記の内容を追加します<be/>';
        print'<form method="post" action="message_reply_add_check_done.php">';
        //print'<input type="hidden" name="name" value="'.$pro_name.'">';
        print'<input type="hidden" name="answer" value="'.$answer.'">';
        print'<br/>';
        print'<input type="hidden" name="question_id" value="'.$question_id.'">';
         print'<input type="hidden" name="procode" value="'.$pro_code.'">';
        print'<br/>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
	}


?>
<form method="post" action="con_product.php">
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>



</body>
</html>