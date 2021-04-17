<?php
function html_cut($text, $max_length)
{
    $tags   = array();
    $result = "";

    $is_open   = false;
    $grab_open = false;
    $is_close  = false;
    $in_double_quotes = false;
    $in_single_quotes = false;
    $tag = "";

    $i = 0;
    $stripped = 0;

    $stripped_text = strip_tags($text);
    while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length) {
        $symbol  = $text[$i];

        $result .= $symbol;

        switch ($symbol) {
            case '<':
                $is_open   = true;
                $grab_open = true;
                break;

            case '"':
                if ($in_double_quotes)
                    $in_double_quotes = false;
                else
                    $in_double_quotes = true;

                break;

            case "'":
                if ($in_single_quotes)
                    $in_single_quotes = false;
                else
                    $in_single_quotes = true;

                break;

            case '/':
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
                if ($is_open) {
                    $is_open   = false;
                    $grab_open = false;
                    array_push($tags, $tag);
                    $tag = "";
                } else if ($is_close) {
                    $is_close = false;
                    array_pop($tags);
                    $tag = "";
                }

                break;

            default:
                if ($grab_open || $is_close)
                    $tag .= $symbol;

                if (!$is_open && !$is_close)
                    $stripped++;
        }

        $i++;
    }

    while ($tags)
        $result .= "</" . array_pop($tags) . ">";

    return $result;
}
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
echo $html;
// $text = 'asdasdsadsadsadsa';
// echo $text[1];
print_r(html_cut($html, 400));
