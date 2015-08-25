<?php

try
{
$member_email=$_POST['email'];
$member_pass=$_POST['pass'];


$member_email=htmlspecialchars($member_email);
$member_pass=htmlspecialchars($member_pass);


$member_pass=md5($member_pass);
if(isset($_POST['save'])==true)
{
		$save =$_POST['save'];


	if($save=='on'){
	setcookie('email',$member_email,time() +60*60*24*14);
	
	}
	else
	{
	setcookie('email','');
	
	}
}


	$dsn='mysql:dbname=jobhunt;host=localhost';
	$user='root';
	$password='root';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');


	$sql='SELECT code,name,score FROM mst_member WHERE email=? AND password=?';
	$stmt=$dbh->prepare($sql);
	$data[]=$member_email;
	$data[]=$member_pass;
	$stmt->execute($data);
	$dbh=null;


	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		print'メールアドレスかパスワードがまちがっています。<br/>';
		print'<a href="member_login.php">戻る</a>';
	}
	else
	{
		session_start();
		$_SESSION['login']=1;
		//$_SESSION['staff_code']=$staff_code;
		$_SESSION['member_name']=$rec['name'];
		$_SESSION['score']=$rec['score'];
		$_SESSION['code']=$rec['code'];

		header('Location:search_top.php');

	}


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	exit();
}

?>
