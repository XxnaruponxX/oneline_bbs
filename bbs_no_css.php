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

   $sql = 'INSERT INTO `posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'",now());';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

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

</body>
</html>