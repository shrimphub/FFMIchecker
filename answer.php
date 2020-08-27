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

$height = '';
$age = '';
$sex = '';
$AI ='';
//DBの取得
$stmts = $db->prepare('SELECT height age sex AI FROM const where id=?');
$stmts->execute(array($_SESSION['id']));

$r = $stmts->fetch();
$height = $r['height'];
$age =$r['age'];
$sex =$r['sex'];
$AI =$r['AI'];


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
    <h3>現在のあなたのFFMI</h3>
      <p><?php echo ($_SESSION['weight'])*($_SESSION['BLP']);?></p>
    <h3>現在のあなたの１日の総消費カロリー</h3>
      <p><?php $height ?></p>
  </div>
</body>