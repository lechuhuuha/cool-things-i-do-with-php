<?php

/**
 * Html cut function from Stack overflow username : code ex machina
 * I had add explanation for those who don't understand
 * 
 * @param string $text
 * @param number $max_length
 * @return string $result
 * 
 */
function html_cut($text, $max_length)
{
    // The array of tag when we stripped from $text
    $tags   = array();
    // The result we will get after stripped
    $result = "";

    // If the $test have < then is in open state
    $is_open   = false;
    // If the $test have open state then is had grab
    $grab_open = false;
    // If the $text have / then is in close state
    $is_close  = false;
    // If the $text have " then is in double quoute state
    $in_double_quotes = false;
    // If the $text have ' then is in double quoute state
    $in_single_quotes = false;
    // The tag name that will get inject into $tags array
    $tag = "";

    $i = 0;
    // Number the $text has been stripped
    $stripped = 0;
    $stripped_text = strip_tags($text);
    // echo (strlen($stripped_text));
    // for ($i = 0; $i < strlen($stripped_text); $i++) {
    //     echo '<pre>';
    //     echo $stripped_text[$i];
    // }

    // While $i < the length of the original $text 
    // and number of time the $test has been stripped < the length of the stripped text 
    // and number of time the $test has been stripped < the length we want the $text to have
    while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length) {
        // $symbol = each of the word in the $text
        $symbol  = $text[$i];
        // $result will get the value of $symbol
        $result .= $symbol;
        // <h2>Title &amp; Meta
        // i use var_dump to demonstate how this work
        echo '<pre>';
        var_dump('this is the ' . $i .  ' symbol  ' . $symbol);

        switch ($symbol) {
            case '<':
                // $text in the open and grab state
                $is_open   = true;
                $grab_open = true;
                break;

            case '"':
                // $text in the double quotes state
                if ($in_double_quotes)
                    $in_double_quotes = false;
                else
                    $in_double_quotes = true;

                break;

            case "'":
                // $text in the single quotes state

                if ($in_single_quotes)
                    $in_single_quotes = false;
                else
                    $in_single_quotes = true;

                break;

            case '/':
                // $text in the close state
                if ($is_open && !$in_double_quotes && !$in_single_quotes) {
                    $is_close  = true;
                    $is_open   = false;
                    $grab_open = false;
                }

                break;

            case ' ':
                if ($is_open)
                    $grab_open = false;
                else
                    $stripped++;

                break;

            case '>':
                // if in open state 
                if ($is_open) {
                    $is_open   = false;
                    $grab_open = false;
                    // Push the $tag we get in default case to $tags array
                    array_push($tags, $tag);
                    // h2
                    // You can see this var_dump to see how its work 
                    var_dump($tag);
                    var_dump(' <br> This is the ' . $i . ' tag array to push');
                    var_dump($tags);
                    // reset the $tag
                    $tag = "";
                } else if ($is_close) {
                    $is_close = false;
                    array_pop($tags);
                    $tag = "";
                }

                break;
                // default case when $symbol is the string
            default:
                // if $text in grab state or close state then $symbol  is the tag 
                if ($grab_open || $is_close)
                    $tag .= $symbol;
                // h2
                var_dump('this is ' . $i  . ' tag ' . $tag);

                // if not then we successfull stripped 1 word
                if (!$is_open && !$is_close)
                    $stripped++;
                break;
        }
        $i++;
        echo '<br>' . 'Number has stripped : ' . $stripped;
    }
    // While $tags array has value then we loop through it 
    // then add $tags in last position of $result
    while ($tags) {
        $result .= "</" . array_pop($tags) . ">";
        // echo '<h2>Title &amp; Meta</h2>';
        // var_dump($result);
        // echo '<br>';
    }

    return $result;
}
$testHtml = '<div><h2>Title &amp; Meta</h2></div>';
echo $testHtml;

print_r(html_cut($testHtml, 16));


// $text = 'asdasdsadsadsadsa';
// echo $text[1];