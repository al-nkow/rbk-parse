<?php
require 'db.php';

require_once("vendor/autoload.php");

$html = file_get_contents("https://www.rbc.ru/");

phpQuery::newDocument($html);

$links = pq("#js_news_feed_banner .js-news-feed-list")->find("a.js-news-feed-item");

$full = array();

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
      $dataOverview = $overview->text();
      $dataImage = $image->attr("src");
      $dataBody  = $body->text();

      $full[] = array(
        "title" => $dataTitle,
        "overview" => $dataOverview,
        "image" => $dataImage,
        "body"  => $dataBody,
        "link" => $url,
      );
















    }
  }








}







phpQuery::unloadDocuments();
?>


<ul> 
  <?php foreach($full as $value): ?> 
    <li> 
      <h3>
        <?php echo($value['title']); ?>
      </h3> 
      <div>
        <a href="./news.php?id=5" target="_blank">
        111 сылка на новость
        </a>
      </div>
      <div>
        <a href="<?php echo($value['link']); ?>" target="_blank">
        оригинал статьи
        </a>
      </div>
      <img src="<?php echo($value['image']); ?>"> 
      <p>
        <?php echo($value['overview']); ?>
      </p>
      <div>
        <?php echo($value['body']); ?>
      </div> 
    </li> 
  <?php endforeach; ?>
 </ul>









