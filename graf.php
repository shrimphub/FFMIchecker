<?php
//データーベースに接続
require('dbconnect.php');
session_start();
  
$TEED = '';
$FFMI = '';
$date = '';
//DBの取得
$stmts = $db->prepare('SELECT BMR*AI, weight*BLP/height/height, adate FROM const, variable where const.id=variable.const_id AND const.id=?');
$stmts->execute(array($_SESSION['id']));

//グラフのプロットを複数にさせる
while( $r = $stmts->fetch(PDO::FETCH_ASSOC)){
  $FFMI = $FFMI .'"'. $r['weight*BLP/height/height'].'",';
  $date = $date . '"'. $r['adate'] .'",';
  $TEED = $TEED .'"'. $r['BMR*AI'].'",';
}

//余白を取り除かせる
$FFMI = trim($FFMI,",");
$date = trim($date,",");
$TEED = trim($TEED,",");
?>

<!DOCTYPE html>
<html lang="ja">
<!-- chart.jsの読み込み -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="fnc.css">
</head>

<body>
<h1>FFMI checker</h1>
<canvas id="FFMI_Chart"></canvas>
<canvas id="TEED_Chart"></canvas>
</body>
<!-- 現在のFFMIの値のチャート -->
<script>
   var myData = document.getElementById('FFMI_Chart');
   var chart = new Chart(myData, {
       type: 'line',
       data: {
           labels: [<?php echo $date ?>],
           datasets: [{
               label: '現在のFFMIの値',
               backgroundColor: 'rgb(255, 99, 132)',
               borderColor: 'rgb(255, 99, 132)',
               data: [<?php echo $FFMI ?>],
               lineTension: 0,
               fill: false
           }]
       }
       });
</script> 
<!-- １日の総消費カロリーのチャート -->
<script>
   var myData = document.getElementById('TEED_Chart');
   var chart = new Chart(myData, {
       type: 'line',
       data: {
           labels: [<?php echo $date ?>],
           datasets: [{
               label: '１日の総消費カロリー',
               backgroundColor: 'rgb(255, 99, 132)',
               borderColor: 'rgb(255, 99, 132)',
               data: [<?php echo $TEED ?>],
               lineTension: 0,
               fill: false
           }]
       }
       });
</script>
</html>
