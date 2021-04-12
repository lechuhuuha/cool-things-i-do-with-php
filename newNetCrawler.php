<?php
// define('DEFAULT_URL', 'http://www.nettruyen.com/truyen-tranh/toi-nguyen-duoc-chet-de-lay-trinh-tiet-em-36969#nt_listchapter');
// define('DEFAULT_TAG', 'ul');
// require __DIR__ . '/Loader.php';
// \Autoload\Loader::init(__DIR__ . '/..');
// $vac = new Hoover();
// // $newHtml = $vac->getContent(DEFAULT_URL);
// $newHtml = $vac->getTags(DEFAULT_URL, DEFAULT_TAG);
// // print_r($newHtml);
// echo '<pre>';
// preg_match('#<script type=\"application/ld\+json\">(.*)</script>#is', file_get_contents(DEFAULT_URL), $match);

// print_r($match[1]);
// $stdClassObject = (json_decode($match[1]));
// print_r($stdClassObject);
// print_r($newHtml);
define('DEFAULT_URL', 'http://www.nettruyen.com/truyen-tranh/toi-nguyen-duoc-chet-de-lay-trinh-tiet-em-36969#nt_listchapter');
define('DEFAULT_COMIC_NAME', 'toi-nguyen-duoc-chet-de-lay-trinh-tiet-em');
define('DEFAULT_TAG', 'a');
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');


$deep = new Deep();
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);
$array = $deep->scan($url, $tag);
$newArray = array();
echo '<pre>';
foreach ($array as $item) {
    $src = $item['attributes']['href'] ?? null;
    if ($src) {
        if (preg_match('/^(.*(\btruyen-tranh\b)[^$]*)$/', $src)) {
            if (
                !in_array($src, $newArray)
                && strpos($src, 'chap-')
                && strpos($src, DEFAULT_COMIC_NAME)
                && !strpos($src, '#nt_comments')
            ) {
                $newArray[] = $src;
                preg_match('#<script type=\"application/ld\+json\">(.*?)</script>#is', file_get_contents(DEFAULT_URL), $match);
                $stdClassObject = (json_decode($match[1]));
            }
        }
    }
}
$json = json_encode(array('data' => $newArray));
file_put_contents('test.json', $json);
