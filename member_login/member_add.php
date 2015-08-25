<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<h4>■　会員登録画面</h4><br/>

<form method="post" action="member_add_check.php">
	大学名を入力してください<br/>
	<input type="text" name="uni_name"><br/>
	学部を選択してください<br/>
	<input type="radio" name="major" value="bun" checked>文系<br/>
	<input type="radio" name="major" value="ri" checked>理系<br/>
	卒業予定年度を入力してください<br/>
	<input type="text" name="graduate"><br/>
	性別<br/>
	<input type="radio" name="danjo" value="dan" checked>男性<br/>
		<input type="radio" name="danjo" value="jo" checked>女性<br/>
	お名前を入力してください<br/>
	<input type="text" name="name"><br/>
	メールアドレスを入力してください<br/>
	<input type="text" name="email"><br/>
	パスワードを入力してください<br/>
	<input type="password" name="pass"><br/>
	もう一度パスワードを入力してください<br/>
	<input type="password" name="pass2"><br/>
	このサイトをどのようにして知りましたか？<br/>
	<select name="know">
	<?php
	$know=array('インターネット広告','インターネット検索','口コミ','SNS','その他');
	foreach ($know as $val ) {
		print('<option value="'.$val.'">'.$val.'</option>');
	}

	?>
	
</select>
<br/>

	<input type="submit" value="登録">
</form>
</body>
</html>