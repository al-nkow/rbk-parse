<?php
  require 'db.php';

  $i = $_GET['id'];
  $sql = "SELECT * FROM `news` WHERE id='$i'";
  $result = $connection->query($sql);

  $records = $result->fetch_all(MYSQLI_ASSOC);

  if (!$result) {
    echo 'ERROR';
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  <link href="./style.css" rel="stylesheet" type="text/css">
  <title>Document</title>
</head>
<body>
  <div class="wrap">
    <div class="head">
      <a href="/">Новости</a>
    </div>
    <div class="content">
      <?php foreach($records as $value): ?> 
        <div class="title">
          <?php echo($value['TITLE']); ?>
        </div>
        <img class="post-img" src="<?php echo($value['IMAGE']); ?>"> 
        <div class="post-body">
          <?php echo($value['BODY']); ?>
        </div>
      <?php endforeach; ?>
      <a class="source" href="<?php echo($value['LINK']); ?>" target="_blank">
        Источник
      </a>
    </div>
  </div>
</body>
</html>



