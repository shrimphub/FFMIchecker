<?php
// DB接続
require('dbconnect.php');
session_start();

if (!empty($_POST)) {
	// ログインの処理
	if ($_POST['name'] != '' && $_POST['password'] != '') {
		$login = $db->prepare('SELECT * FROM const WHERE name=? AND password=?');
			$login->execute(array(
				$_POST['name']
				,sha1($_POST['password'])
			));
			$member = $login->fetch();
			if ($member) {
				// ログイン成功
				$_SESSION['id'] = $member['id'];
        $_SESSION['time'] = time();
        header('Location: form.php'); exit();

      } else {
        // ログイン失敗
				$error['login'] = 'failed';
			}
	} else {
		$error['login'] = 'blank';
		}
	}
	?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>FFIM CHECKER</title>

	<link rel="stylesheet" href="fnc.css">
</head>
<body>
	<h1>ログインする</h1>
	<div class="instract">
		<p>メールアドレスとパスワードを記入してログインしてください。</p>
		<p>入会手続きがまだの方はこちらからどうぞ。</p>
		<p>&raquo;<a href="join/">入会手続きをする</a></p>
	</div>
	<form action="" method="post">
		<div id="name" 	class="form-group">	
			<label>ユーザー名</lable>
			<input type="text" name="name" size="35" maxlength="255" value=""/>
		</div>
	  
		<div id="password" class="form-group">	
			<lable>パスワード</lable>
			<input type="password" name="password" size="35" maxlength="255" value="" />
			<?php if (!empty($_POST)): ?> 
			<!-- 空欄だった時の処理 -->
	    <?php if ($error['login'] == 'blank'):?>
			<p class="erorr-message">＊メールアドレスとパスワードをご記入ください</p>
			<?php endif; ?>
			<!-- nameとpasswordが一致しなかった時の処理 -->
			<?php if ($error['login'] !== 'blank' && $error['login'] = 'failed'):?>
			<p class="erorr-message">＊ログインに失敗しました。正しくご記入ください</p>
			<?php endif; ?>
			<?php endif; ?>
		<div>
		<div class="submit-btn">
			<input type="submit" class="submit-control" value="ログインする" />
		</div>
		</div>
	</form>
</body>
</html>
