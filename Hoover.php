<?php

class Hoover
{

    protected $content = NULL;

    public function getContent($url)
    {
        if (strpos($url, 'http') !== 0) {
            $url = 'http://' . $url;
        }
        $this->content = new DOMDocument('1.0', 'uft-8');
        $this->content->preserveWhiteSpace = FALSE;

        @$this->content->loadHTMLFile($url);
        return $this->content;
    }
    public function getTags($url, $tag)
    {
        $count = 0;
        $result = array();
        $elements = $this->getContent($url)->getElementsByTagName($tag);
        foreach ($elements as $node) {
            $result[$count]['value'] = trim(preg_replace('/\s+/', ' ', $node->nodeValue));
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attrNode) {
                    $result[$count]['attributes'][$name] = $attrNode->value;
                }
            }
            $count++;
        }
        return $result;
    }
    public function getAttribute($url, $attr, $domain = NULL)
    {
        $result = array();
        $elements = $this->getContent($url)->getElementsByTagName('*');
        foreach ($elements as $node) {
            if ($node->hasAttribute($attr)) {
                $value = $node->getAttribute($attr);
                if ($domain) {
                    if (stripos($value, $domain) !== FALSE) {
                        $result[] = trim($value);
                    }
                } else {
                    $result[] = trim($value);
                }
            }
        }
        return $result;
    }
}
