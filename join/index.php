<?php 
//DB接続
require('../dbconnect.php');
//セッションアラートon
session_start();
//submitされたときに行う確認
if (!empty($_POST)) {
	// エラー項目の確認
	if ($_POST['name'] == '') {
		$error['name'] = 'blank';
	}
	if ($_POST['password'] == '') {
		$error['password'] = 'blank';
	}
	if ($_POST['height'] == '') {
		$error['height'] = 'blank';
	}
	if ($_POST['age'] == '') {
		$error['age'] = 'blank';
	}


  // 重複アカウントのチェック
	if (empty($error)) {
		$member = $db->prepare('SELECT COUNT(*) AS cnt FROM const WHERE	name=?');
		$member->execute(array($_POST['name']));
		$record = $member->fetch();
		if ($record['cnt'] > 0) {
			$error['name'] = 'duplicate';
			print('そのユーザー名はすでに使われています');
		}
	}

	if (empty($error)) {
		$_SESSION['join'] = $_POST;
	  header('Location: check.php');
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>FFMI CHECKER</title>
	<link rel="stylesheet" href="join.css">
</head>

<body>
	<div id="conteiner" class="">
    <h1 class="header">会員登録</h1>
		<p  class="instract">ユーザー名、パスワード、身長、年齢等をご記入ください</p>
    <form action="" method="post" enctype="multipart/form-data">
			<div id="name" class="form-group">
				<label>ユーザー名</lable>
				<input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])){echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');} ?>"/>
				<!-- 空欄だった時の処理 -->
				<?php if (!empty($_POST)): ?> 
	      <?php if ($_POST['name'] == ''):?>
				<p class="erorr-message">＊ユーザー名が入力されていません</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>
			
			<div id="password" class="form-group">
				<label>パスワード</label>
				<input type="password" class="form-control" name="password" value="<?php if(isset($_POST['password'])){echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');} ?>"/>
				<!-- 空欄だった時の処理 -->
				<?php if (!empty($_POST)): ?> 
	      <?php if ($_POST['password'] == ''):?>
				<p class="erorr-message">＊パスワードが入力されていません</p>
				<?php endif; ?>
				<?php endif; ?>
    	</div>

			<div id="height" class="form-group">
				<label class="form-text">　身　長　</label>
				<input type="number" class="form-control" name="height" maxlength="3" value="<?php if(isset($_POST['height'])){echo htmlspecialchars($_POST['height'], ENT_QUOTES, 'UTF-8');} ?>"/>
				<!-- 空欄だった時の処理 -->
				<?php if (!empty($_POST)): ?> 
	      <?php if ($_POST['height'] == ''):?>
				<p class="erorr-message">＊身長が入力されていません</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>

			<div id="age" class="form-group">
				<label class="form-text">　年　齢　</label>
				<input type="number" class="form-control" name="age"  maxlength="3" value="<?php if(isset($_POST['age'])){echo htmlspecialchars($_POST['age'], ENT_QUOTES, 'UTF-8');} ?>"/>
				<!-- 空欄だった時の処理 -->
				<?php if (!empty($_POST)): ?> 
	      <?php if ($_POST['age'] == ''):?>
				<p class="erorr-message">＊年齢が入力されていません</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>
	
			<div id="sex" class="form-group">
				<label class="form-text">　性　別　</label>
				<label><input type="radio" name="sex" value="male">男性</label>
				<label><input type="radio" name="sex" value="female" checked>女性</label>
				<!-- 空欄だった時の処理 -->
				<?php if (!empty($_POST)): ?> 
	      <?php if ($_POST['sex'] = 'blank'):?>
				<p class="erorr-message">＊性別が選択されていません</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>

			<div id="AI" class="form-group">
				<p>あなたの運動量の中でもっとも当てはまるものを選んでください</p>
				<label><input type="radio" name="AI" value="1.200" checked>学校に歩いて行ったり等はするけど特に運動とか筋トレはしない</label>
				<br>
				<label><input type="radio" name="AI" value="1.375">１週間に１〜２回の軽い運動や筋トレをする</label>
				<br>
				<label><input type="radio" name="AI" value="1.550">１週間に2〜3回程の運動や筋トレをする</label>
				<br>
				<label><input type="radio" name="AI" value="1.725">１週間に4〜5回の運動や筋トレをする</label>
				<br>
				<label><input type="radio" name="AI" value="1.900">毎日激しい運動をする</label>
				<br>
		
			</div>
		<div class="submit-btn">
			<input type="submit" class="submit-control" value="入力内容を確認する" />
	  </div>
	  </form>
  </div>
</body>
</html>
