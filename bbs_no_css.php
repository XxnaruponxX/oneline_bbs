<?php
//データベースに接続し、SQLを実行し、切断する部分を記述しよう
// ここにDBに登録する処理を記述する
$dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
  //POST送信されたらINSERT文を実行
  if (!empty($_POST)) {
  	$nickname = $_POST['nickname'];
  	$comment = $_POST['comment'];
 
   //SQL文作成
   $sql = 'INSERT INTO `posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'",now());';

var_dump($sql);

  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  //SELECT文の実行

  //SQL文作成(SELECT文)
  $sql = 'SELECT * FROM `posts`;';

  //実行
$stmt = $dbh->prepare($sql);
  $stmt->execute();
  	
   //配列で取得したデータを格納
   //配列を初期化
   $post_datas = array();
  //繰り返し文でデータ取得(フェッチ)
  while (1) {
  	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
  	if ($rec == false) {
  		break;
  		# code...
  	}

  	//echo $rec['nickname'];
  	$post_datas[] = $rec;
  }
  	# code...
  }
  

   

$dbh = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->
    <?php
      foreach ($post_datas as $post_each) {
         echo $post_each['nickname'].'<br>';
         echo $post_each['comment'].'<br>';   
         echo $post_each['created'].'<br>';   
         echo '<hr>'; 
      }
      ?>

</body>
</html>