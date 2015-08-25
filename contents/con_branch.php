<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print'ようこそゲスト様<br/>';
	print'<a href="member_login.php">会員ログイン</a><br/>';
	print'<br/>';
}
else
{
	print'ようこそ';
	print $_SESSION['member_name'];
	print'様';
	print'<a href="member_logout.php">ログアウト</a><br/>';
	print'<br/>';

}

if(isset($_POST['add'])==true)
{
	header('Location:con_product.php');
}


?>