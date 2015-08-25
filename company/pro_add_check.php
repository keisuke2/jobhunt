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
require_once('../common/common.php');
$post=sanitize($_POST);

$pro_name=$post['name'];


//$pro_name=htmlspecialchars($pro_name);


if($pro_name=='')
{
	print'企業名が入力されていません<br/>';
}
else
{
	print'企業名';
	print$pro_name;
	print'<br/>';
}



if($pro_name=='')
{
	print'<form>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'</form>';
}
else
{

 print'<form method="post" action="pro_add_done.php">';
 print'<input type="hidden" name="name" value="'.$pro_name.'">';

 print'<br/>';

 print'<input type="button" onclick="history.back()" value="戻る">';
 print'<input type="submit" value="OK">';
 print'</form>';

}
?>


</body>
</html>