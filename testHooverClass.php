<?php


use function PHPSTORM_META\type;

define('DEFAULT_URL', 'http://www.nettruyen.com/truyen-tranh/vo-dich-kiem-vuc/chap-118/703384');
define('DEFAULT_TAG', 'img');
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');
$vac = new Hoover();
// check to see the directory empty or not
// $pid = basename($_GET["prodref"]); //let's sanitize it a bit
// $dir = "/assets/$pid/v";

// if (is_dir_empty($dir)) {
//     echo "the folder is empty";
// } else {
//     echo "the folder is NOT empty";
// }

// function is_dir_empty($dir)
// {
//     if (!is_readable($dir)) return NULL;
//     return (count(scandir($dir)) == 2);
// }
// check to see the directory empty or not
$string = file_get_contents("./test.json");
$json = json_decode($string);
foreach ($json->data as $url) {
    // $newHtml = $vac->getContent($url);
    $tagA =  $vac->getTags($url, DEFAULT_TAG);
    echo '<pre>';
    preg_match('#<script type=\"application/ld\+json\">(.*?)</script>#is', file_get_contents($url), $match);
    $stdClassObject = (json_decode($match[1]));
    foreach ($stdClassObject as $key => $value) {
        echo 'Key :' .  $key . PHP_EOL;
        echo 'Value : ' . $value . PHP_EOL;
        if ($key == 'headline') {
            if (!file_exists($value)) {
                mkdir('netComics/' . $value);
            }
            if (scandir($value)) {
                netCrawler($tagA, $value);
            }
        }
    }
    echo '</pre>';
}


// $newHtml = $vac->getContent(DEFAULT_URL);
// $tagA =  $vac->getTags(DEFAULT_URL, DEFAULT_TAG);

// echo '<pre>';
// print_r($newHtml);
// echo '</pre>';


// print_r($newHtml->documentElement);
// $nodeVal =  ($newHtml->documentElement->nodeValue);
// echo '<pre>';
// echo  $nodeVal;

// echo $result;
// echo '<br>';



// $url = strip_tags($_GET['url'] ?? DEFAULT_URL);
// $tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);

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
        // $ch = curl_init($netUrl);
        $ch = curl_init($netUrl);
        echo $netUrl;
        $fp = fopen('netComics/' . $dir . '/trang '   . $i .  '.jpg', 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.nettruyen.com/');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
// netCrawler($tagA);
