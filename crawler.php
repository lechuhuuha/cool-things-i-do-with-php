<?php
function crawl_page($url, $depth = 5)
{
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);
    $anchors = $dom->getElementsByTagName('img');
    print_r($anchors);
    foreach ($anchors as $element) {
        $href = $element->getAttribute('href');
        $parts = parse_url($url);
        print_r($parts);
    }
}
crawl_page('http://www.nettruyen.com/truyen-tranh/quyen-ba-thien-ha/chap-378/696792');

