<?php
//DBに接続
require('dbconnect.php');
session_start();
if (isset($_SESSION['id'])) {
  // ログインしている
  // ユーザのidの取得
	$members = $db->prepare('SELECT * FROM const WHERE id=?');
	$members->execute(array($_SESSION['id']));
	$member = $members->fetch();
} else {
	// ログインしていない
	header('Location: login.php');
	exit();
}
if (!empty($_POST)) {
  if($member['sex'] == 'male')  {
    $BMR = (66.0+13.7*$_POST['weight']+5.0*$member['height']-6.8*$member['age'])*$member['AI'];
  }
  if($member['sex'] == 'female')  {
    $BMR = (66.0+13.7*$_POST['weight']+5.0*$member['height']-6.8*$member['age'])*$member['AI'];
  }
}

// varテーブルに登録する
if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO variable SET const_id=?, BMR=?, weight=?, BLP=?, adate=NOW()');
    echo $ret = $statement->execute
    (array(
      $_SESSION['id'],
      $BMR,
      $_POST['weight'],
      1-$_POST['BLP']*0.01
    ));
    $member_id = $member['id'];
    header('Location: graf.php');
	exit();
}
?>
<!--数値を入力するフォームを用意-->
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>FFMI CHECKER</title>
	<link rel="stylesheet" href="fnc.css">
</head>
<body>
  <h1>FFMI checker</h1>
  <div class="instraction">
    <h2>このアプリではあなたのFFMIと１日の予想消費カロリーを算出できます</h2>
  <div class="instract">
    本日の体重・体脂肪率を記入してください
  </div>
  <form id="graphform" action="" method="post" >
    <div class="form-group" style="display:inline-block">
      体　重　:<input type="number" name="weight" value=''>(Kg)
      </div>
    <div class="form-group" style="display:inline-block">
      体脂肪率:<input type="number" name="BLP" value=''>(％)
    </div>
    <div class="submit-btn">
      <input type="submit" class="submit-control" value="送信">
    </div>

  </form>
</body>
