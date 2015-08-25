<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php
$company_name=$_POST['company_name'];
$url=$_POST['url'];
$company_name=htmlspecialchars($company_name);
$url=htmlspecialchars($url);


if($company_name==''||$url=='')
{
	print'企業名かURLが入力されてません<br/>';
	print'<form>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'</form>';

}
else 
{
	print'企業名<br/>';
	print $company_name;
	print'<br/>';
	print$url;
	print'<br/>';




	print'<form method="post" action="company_add_done.php">';
	print'<input type ="hidden" name="company_name" value="'.$company_name.'" >';
	print'<input type ="hidden" name="url" value="'.$url.'" >';
	print'<br/>';

	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="OK">';
	print'</form>';

} 









?>


</body>
</html>