<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

 <?php

$uni_name=$_POST['uni_name'];
$major=$_POST['major'];
$graduate=$_POST['graduate'];
$danjo=$_POST['danjo'];
$member_name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$know=$_POST['know'];
//さにタイズ

if($uni_name=='')
{
	print'大学名が入力されていません';
	print'<br/>';
}
else
{
	print'大学名<br/>';
	print $uni_name;
	print'<br/>';
}
if($graduate=='')
{
	print'卒業年度が入力されていません';
	print'<br/>';
}
else
{
	print'卒業年度';
	print$graduate;
	print'<br/>';
}
if($major='')
{
print'専攻科目が入力されていません。';
}
else
{
	print'専攻科目';
	print $major;
	print'<br/>';

}
if($danjo='')
{
	print'性別が入力されていません';

}
else
{
	print'性別';
	print $danjo;
	print'<br/>';
}
if($email=='')
{
	print'メールアドレスが入力されていません';
	print'<br/>';
}
else
{
	print'メールアドレス<br/>';
	print$email;
	print'<br/>';

}
if($member_name=='')
{
	print'お名前が入力されていません';
	print'<br/>';

}
else
{
	print'お名前<br/>';
	print $member_name;
	print'<br/>';
}
if($pass=='')
{
	print'パスワードが入力されていません。<br/>';
}

if($pass!=$pass2)
{
	print'パスワードが一致しません';
	print'<br/>';

}
if($know=='')
{
	print'どのようにこのサイトを知ったのか入力してください';
	print'<br/>';
}
else
{
	
	print$know;
	print'<br/>';

}

/*
if($uni_name==''||$major==''||$graduate==''||$member_name==''||$danjo==''||$email==''||$pass==''||$pass!=$pass2)
{
	print'<form>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'</form>';

}
else
{
	*/
	$pass=md5($pass);
	print'<form method="post" action="member_add_done.php">';
	print'<input type="hidden" name="uni_name" value="'.$uni_name.'">';
	print'<input type="hidden" name="major" value="'.$major.'">';
	print'<input type="hidden" name="graduate" value="'.$graduate.'">';
	print'<input type="hidden" name="danjo" value="'.$danjo.'">';
	print'<input type="hidden" name="email" value="'.$email.'">';
	print'<input type="hidden" name="name" value="'.$member_name.'">';
	print'<input type="hidden" name="pass" value="'.$pass.'">';
	print'<input type="hidden" name="know" value="'.$know.'">';
	print'<br/>';
	print'<input type="button" onclick="history.back()" value="戻る">';
	print'<input type="submit" value="OK">';
	print'</form>';


//}


 ?>

</body>
</html>