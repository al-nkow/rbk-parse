<?php
  require_once("vendor/autoload.php");
  require 'db.php';
  require 'init.php';

  function full_trim($str)
  {
    return trim(preg_replace('/\s{2,}/', ' ', $str));
  }

  $html = file_get_contents("https://www.rbc.ru/");

  phpQuery::newDocument($html);
  $links = pq("#js_news_feed_banner .js-news-feed-list")->find("a.js-news-feed-item");

  foreach($links as $link){
    $link = pq($link);
    $linkUrl = $link->attr("href");

    if (preg_match("/www\.rbc\.ru/", $linkUrl))
    {
      $url = $link->attr("href");
      if(!empty($url)) $data_link = file_get_contents($url);

      $document_с = phpQuery::newDocument($data_link);
      $content = $document_с->find('.article__content');

      $title = $content->find('.js-slide-title');
      $overview = $content->find('.article__text__overview');
      $image = $content->find('.article__main-image__image');
      $body = $content->find('.article__text_free');

      if ($title && $body)
      {
        $dataTitle = $title->text();
        $dataImage = $image->attr("src");
        $dataBody  = $body->text();

        $dataTitle    = $connection->real_escape_string($dataTitle);
        $dataImage    = $connection->real_escape_string($dataImage);
        $dataBody     = $connection->real_escape_string($dataBody);
        $url          = $connection->real_escape_string($url);

        $sql = "INSERT INTO `news` (`id`, `title`, `image`, `body`, `link`) VALUES
        (NULL, '".$dataTitle."', '".$dataImage."', '".$dataBody."', '".$url."')";

        $result = $connection->query($sql);

        if (!$result) {
          echo 'ERROR';
        }
      }
    }
  }
  phpQuery::unloadDocuments();

  $getNewsQuery = 'SELECT * FROM `news`';
  $news = $connection->query($getNewsQuery);
  $records = $news->fetch_all(MYSQLI_ASSOC);

  if (!$news) {
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
      Новости
    </div>
    <div class="content">
      <?php foreach($records as $value): ?>
      <div class="preview">
        <div class="preview__title">
          <?php echo($value['TITLE']); ?>
        </div>
        <div class="preview__body">
          <?php echo(mb_substr(full_trim($value['BODY']), 0, 200)); ?>...
        </div>
        <a href="./news.php?id=<?php echo($value['ID']); ?>" class="more">
          Подробнее
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>








