<?php 
require './vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;

$search_value = 'abcd';
$url = 'https://wwww.google.com/'.$search_value;

$client = new \GuzzelHttp\Client();
$res = $client->request('GET', $url);
$html = ''.$res->getBody();

$crawler = new Crawler($html);
$nodeValues = $crawler->filter('')->each(function(Crawler $node, $i){
    echo $node->html();
    $text = $node->text();
    $image = $node->filter('img')->attr('src');
    $items_array = [
        'image' => $image,
        'text' => $text,
    ];
    return $items_array;
});
?>