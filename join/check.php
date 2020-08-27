<?php 
//DB接続
require('../dbconnect.php');
//セッションアラートon
session_start();
//indexの記入に不備があったら戻る
if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}
if(!empty($_POST)) {
//constテーブルへの登録をする
$statement = $db->prepare('INSERT INTO const SET name=?, password=?,	height=?, age=?, sex=?, AI=?, created=NOW()');
		echo $ret = $statement->execute(array(
			$_SESSION['join']['name'],
			sha1($_SESSION['join']['password']),
			$_SESSION['join']['height']*0.01,
			$_SESSION['join']['age'],
			$_SESSION['join']['sex'],
			$_SESSION['join']['AI']
		));
		//sessionを上書きしてthanksにジャンプ
		unset($_SESSION['join']);
		header('Location: thanks.php');
		exit();
	}
//echo $_POST['name'];
	?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>FFIM CHECKER</title>

	<link rel="stylesheet" href="join.css" />
</head>

<body>
<div id="content">
  <h1>会員登録</h1>
	<form action="" method="post">
	  <input type="hidden" name="action" value="submit" />
		
		<div id="name" class="form-group">
		  <label>ニックネーム</label>
			<?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES,'UTF-8'); ?>
		</div>

		<div id="password" class="form-group">
			<label>パスワード</label>
			【表示されません】
		</div>

		<div id="height" class="form-group">
			<label>　身　長　</label>
			<?php echo htmlspecialchars($_SESSION['join']['height']); ?>
		</div>
		
		<div id="age" class="form-group">
			<label>　年　齢　</label>
			<?php echo htmlspecialchars($_SESSION['join']['age'], ENT_QUOTES,'UTF-8');?>
		</div>

		<div id="sex" class="form-group">
			<label>　性　別　</lable>
			<?php
			if($_SESSION['join']['sex'] == 'male') {
			echo ('男性');
			};
			if($_SESSION['join']['sex'] == 'female') {
			echo ('女性');
			};
			?>
		</div>

		<div id="AI" class="form-group">
			<dt>あなたの活動レベルで最もを近いもの</dt>			
			<?php 
			if($_SESSION['join']['AI'] == '1.200') {
			echo ('学校に歩いて行ったり等はするけど特に運動とか筋トレはしない');
			} 
			if($_SESSION['join']['AI'] == '1.375') {
			echo ('１週間に１〜２回の軽い運動や筋トレをする');
			}	 
			if($_SESSION['join']['AI'] == '1.550') {
      echo ('１週間に2〜3回程の運動や筋トレをする');
    	}	 
    	if($_SESSION['join']['AI'] == '1.725') {
      echo ('１週間に4〜5回の運動や筋トレをする');
    	}
    	if($_SESSION['join']['AI'] == '1.900') {
      echo ('毎日激しい運動をする');
    	}
			?>
		</div>

	<div class="submit-btn">
		<a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | 
		<input type="submit" class="submit-control" value="登録する" />
	</div>
	</form>
</div>
</body>
</html>
