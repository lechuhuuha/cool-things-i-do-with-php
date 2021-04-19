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
        // echo '<h2>This is result </h2>';
        // var_dump($result);
        // echo '<br>';
    }

    return $result;
}
$testHtml = '<h2>Title &amp; Meta</h2>';
echo $testHtml;

print_r(html_cut($testHtml, 16));

$html = '<div class="module sidebar-linked">
<h4 id="h-linked">Linked</h4>
<div class="linked" data-tracker="lq=1">
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 31108643, position: 0 })">
            <a href="https://stackoverflow.com/q/31108643?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes  default">3</div>
            </a>
            <a href="https://stackoverflow.com/questions/31108643/changed-formation-while-use-character-limit-in-tbs-library?noredirect=1&amp;lq=1" class="question-hyperlink">Changed formation while use character limit in TBS library</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 2345670, position: 1 })">
            <a href="https://stackoverflow.com/q/2345670?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">17</div>
            </a>
            <a href="https://stackoverflow.com/questions/2345670/php-domdocument-get-html-source-of-body?noredirect=1&amp;lq=1" class="question-hyperlink">PHP DOMDocument - get html source of BODY</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 830283, position: 2 })">
            <a href="https://stackoverflow.com/q/830283?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">10</div>
            </a>
            <a href="https://stackoverflow.com/questions/830283/cutting-html-strings-without-breaking-html-tags?noredirect=1&amp;lq=1" class="question-hyperlink">Cutting HTML strings without breaking HTML tags</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 14140596, position: 3 })">
            <a href="https://stackoverflow.com/q/14140596?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">4</div>
            </a>
            <a href="https://stackoverflow.com/questions/14140596/php-substr-function-that-allows-you-to-set-start-and-stop-point-and-keeps-html?noredirect=1&amp;lq=1" class="question-hyperlink">PHP substr() function that allows you to set start and stop point AND keeps HTML formatting?</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 2105169, position: 4 })">
            <a href="https://stackoverflow.com/q/2105169?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">3</div>
            </a>
            <a href="https://stackoverflow.com/questions/2105169/how-to-clip-html-fragments-without-breaking-up-tags?noredirect=1&amp;lq=1" class="question-hyperlink">How to clip HTML fragments without breaking up tags?</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 3108164, position: 5 })">
            <a href="https://stackoverflow.com/q/3108164?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">3</div>
            </a>
            <a href="https://stackoverflow.com/questions/3108164/how-to-truncate-an-html-text-and-still-maintain-the-format-in-php?noredirect=1&amp;lq=1" class="question-hyperlink">How to truncate an html text and still maintain the format, in PHP</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 24330464, position: 6 })">
            <a href="https://stackoverflow.com/q/24330464?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes answered-accepted default">2</div>
            </a>
            <a href="https://stackoverflow.com/questions/24330464/php-substr-breaks-my-table?noredirect=1&amp;lq=1" class="question-hyperlink">PHP substr breaks my table</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 53876030, position: 7 })">
            <a href="https://stackoverflow.com/q/53876030?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes  default">0</div>
            </a>
            <a href="https://stackoverflow.com/questions/53876030/php-send-browser-content-to-text-file?noredirect=1&amp;lq=1" class="question-hyperlink">PHP send browser content to text file</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 50935705, position: 8 })">
            <a href="https://stackoverflow.com/q/50935705?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes  default">0</div>
            </a>
            <a href="https://stackoverflow.com/questions/50935705/php-html-decode-html-entity-decode-breaks-page-with-js?noredirect=1&amp;lq=1" class="question-hyperlink">PHP html_decode/html_entity_decode breaks page with JS</a>
        </div>
        <div class="spacer js-gps-track" data-gps-track="linkedquestion.click({ source_post_id: 2398725, target_question_id: 29627746, position: 9 })">
            <a href="https://stackoverflow.com/q/29627746?lq=1" title="Vote score (upvotes - downvotes)">
                <div class="answer-votes  default">0</div>
            </a>
            <a href="https://stackoverflow.com/questions/29627746/wordpress-filters-and-excerpts?noredirect=1&amp;lq=1" class="question-hyperlink">Wordpress filters and excerpts</a>
        </div>
        <div class="spacer more ml32 pl16 pt8">
            <a href="https://stackoverflow.com/questions/linked/2398725?lq=1">See more linked questions</a>
        </div>
</div>
</div>';
// $text = 'asdasdsadsadsadsa';
// echo $text[1];