<?php
define('DEFAULT_URL', 'http://www.nettruyen.com');
define('DEFAULT_TAG', 'a');
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');

$deep = new Deep();
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);
// foreach ($deep->scan($url, $tag) as $item) {
//     $src = $item['attributes']['src'] ?? null;
//     if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
//         // printf('<br><img src ="%s"/>', $src);
//         echo '<pre>';
//         if (preg_match('/^(.*(\bforumnt.com|comics\b)[^$]*)$/', $src)) {
//             echo $src;
//         }
//     }
// }
$array = $deep->scan($url, $tag);
$newArray = array();
// $fp = fopen('log.json', 'w');

foreach ($array as $item) {
    $src = $item['attributes']['href'] ?? null;
    if ($src) {
        // printf('<br><img src ="%s"/>', $src);
        // echo '<pre>';
        if (preg_match('/^(.*(\btruyen-tranh\b)[^$]*)$/', $src)) {
            if (
                !in_array($src, $newArray)
                && strpos($src, 'http')
                && !strpos($src, 'comments')
                && !strpos($src, 'nt_listchapter')
                && !strpos($src, 'chap')

            ) {

                $newArray[] = $src;

                // fwrite($fp, $src, strlen($src));
            }
        }
    }
}
$json = json_encode(array('data' => $newArray));
file_put_contents('data.json', $json);

// fclose($fp);
