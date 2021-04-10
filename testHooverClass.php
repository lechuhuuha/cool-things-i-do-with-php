<?php

use function PHPSTORM_META\type;

define('DEFAULT_URL', 'http://www.nettruyen.com/truyen-tranh/toi-la-tho-san-co-ki-nang-tu-sat-cap-sss/chap-33/703452');
define('DEFAULT_TAG', 'img');
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');
$vac = new Hoover();
$newHtml = $vac->getContent(DEFAULT_URL);
$tagA =  $vac->getTags(DEFAULT_URL, DEFAULT_TAG);

// echo '<pre>';
// print_r($newHtml);
// echo '</pre>';
echo '<pre>';
preg_match('#<script type=\"application/ld\+json\">(.*?)</script>#is', file_get_contents(DEFAULT_URL), $match);
$stdClassObject = (json_decode($match[1]));
echo gettype($stdClassObject);
foreach ($stdClassObject as $key => $value) {
    echo 'Key :' .  $key . PHP_EOL;
    echo 'Value : ' . $value . PHP_EOL;
    if ($key == 'headline') {
        if (!file_exists($value)) {
            mkdir($value);
        }
        if (scandir($value)) {
            netCrawler($tagA, $value);
        }
    }
}
echo '</pre>';

// print_r($newHtml->documentElement);
$nodeVal =  ($newHtml->documentElement->nodeValue);
// echo '<pre>';
// echo  $nodeVal;

// echo $result;
// echo '<br>';



$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);

// echo 'DUMB OF TAGS : ' . PHP_EOL;
// echo count($tagA);

// echo '<br>';
function netCrawler($tagA, $dir)
{
    for ($i = 0; $i <= count($tagA); $i++) {
        echo '<br>';
        // preg_replace(array('/^\[/', '/\']$/'), '', $tagA[$i]['attributes']['src']);
        $netUrl = (trim($tagA[$i]['attributes']['src'], '//'));
        echo '<br>';
        $ch = curl_init($netUrl);
        $fp = fopen($dir . '/trang '   . $i .  '.jpg', 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.nettruyen.com/');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
// netCrawler($tagA);
