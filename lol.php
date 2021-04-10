<?php
ini_set('max_execution_time', 0);
function preg_substr($start, $end, $str) // Regular expression      

{

    $temp = preg_split($start, $str);

    $content = preg_split($end, $temp[1]);

    return $content[0];
}
function str_substr($start, $end, $str) // string split       

{

    $temp = explode($start, $str, 2);

    $content = explode($end, $temp[1], 2);

    return $content[0];
}
function writelog($str)

{

    @unlink("log.txt");

    $open = fopen("log.txt", "a");

    fwrite($open, $str);

    fclose($open);
}
function getImage($url, $filename = '', $dirName, $fileType, $type = 0)

{

    if ($url == '') {
        return false;
    }

    //get the default file name

    $defaultFileName = basename($url);

    //file type

    $suffix = substr(strrchr($url, '.'), 1);

    if (!in_array($suffix, $fileType)) {

        return false;
    }

    //set the file name

    $filename = $filename == '' ? time() . rand(0, 9) . '.' . $suffix : $defaultFileName;



    //get remote file resource

    if ($type) {

        $ch = curl_init();

        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.nettruyen.com/truyen-tranh/chua-te-hoc-duong-44461');

        $file = curl_exec($ch);

        curl_close($ch);
    } else {

        ob_start();

        readfile($url);

        $file = ob_get_contents();

        ob_end_clean();
    }

    //set file path

    $dirName = $dirName . '/' . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time()) . '/';

    if (!file_exists($dirName)) {

        mkdir($dirName, 0777, true);
    }

    //save file

    $res = fopen($dirName . $filename, 'a');

    fwrite($res, $file);

    fclose($res);

    return $dirName . $filename;
}
// if ($str = file_get_contents('http://truyenqq.com/truyen-tranh/kingdom-vuong-gia-thien-ha-245-chap-673.html')) {
//     // $str = mb_convert_encoding($str, 'utf-8', 'iso-8859-1');
// }
// $url = 'http://www.nettruyen.com/truyen-tranh/chua-te-hoc-duong/chap-490/699995';
// // $dom = new DOMDocument('1.0');
// // $nettruyenStore =  @$dom->loadHTMLFile($url);
// // print_r($dom);
// $doc = new DOMDocument();
// @$doc->loadHTMLFile($url);
// // $h1 = $doc->getElementsByTagName("title")->item(0)->textContent;
// // echo $h1, PHP_EOL;
// print_r($doc);
// $a = 1;
// writelog($str);
// $html = '<a href="url">My Asked text for value <span class="time">15min</span></a>';



// $links = $dom->getElementsByTagName('a');
// foreach ($links as $link) {
//     if ($link->hasChildNodes()) {
//         echo $link->childNodes[0]->nodeName;
//     } else {
//         echo $link->nodeValue;
//     }
// }
$ch = curl_init('http://forumnt.com/content/image.jpg?data=OGVywjyYvtVYluGjHJwFKkoFGJoRMBWONoUjUbY730gHR9sTH9ReAzfw3H4++p+yb2lE1RM2f3Ikd9MxIcZqaWRJLJ1eJS4rHDThuvTUVLc=');
$fp = fopen('test/test5.jpg', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_REFERER, 'http://www.nettruyen.com/');
curl_exec($ch);
curl_close($ch);
fclose($fp);
$doc = new DomDocument;

// We need to validate our document before refering to the id
$doc->validateOnParse = true;
@$doc->loadHtml(file_get_contents('http://www.nettruyen.com/truyen-tranh/chua-te-hoc-duong/chap-490/699995'));

print_r($doc->getElementsByTagName('img'));

foreach ($doc->getElementsByTagName('img') as $key => $value) {
    print_r($value);
}
