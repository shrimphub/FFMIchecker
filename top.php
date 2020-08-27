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
    <label>ログインはこちらから→</label>
    <a href="login.php">ログイン</a><br>
    <label>新規登録がお済ではない方はこちらから→</label><a href="join/index.php">新規登録</a>
    <h3>このアプリの機能</h3>
      <p>このアプリではあなたのFFMIと１日の予想消費カロリーを算出し、それの変化の推移を折れ線ブラフで表示します</p>
    <div class="imgs">
      <img class="form_img" src="img/FireShot Capture 003 - FFMI CHECKER - localhost.png" alt="挿入画面">
      <img class="graf_img" src="img/FireShot Capture 006 - Document - localhost.png" alt="折れ線グラフ">
    </div>

    <div>
    <h3>FFMIとは</h3>
      <p>自分の体の筋肉量を測ることを目的とした指標です。
      「Fat Free Mass Index」の頭文字をとったこの指標は除脂肪体重指標とも呼ばれ、肥満度ではなく筋肉量の多さを測ることができます。指標が20以下は一般人、20～22はトレーニー、22～23はエリートトレー二―、23以上は才能ある人と言われています。</p>
      <p>計算方法:体重[kg] x (1 - 体脂肪率) ÷ (身長[m])2 = 除脂肪体重[kg] ÷ (身長[m])2</p>
    <h3>１日の総消費カロリーとは</h3>
      <p>その名の通り１日に消費するであろう総消費カロリーです。</p>
      <p>計算方法:男性: (13.397 × 体重kg + 4.799 x 身長cm - 5.677 × 年齢 + 88.362)×運動量レベル<br>
      　　　　女性: (9.247 × 体重kg + 3.098 x 身長cm - 4.33 × 年齢 + 447.593)×運動量レベル</p>
    </div>
 


</body>