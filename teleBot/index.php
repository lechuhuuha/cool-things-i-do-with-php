<?php
$BOT_TOKEN = "1700213425:AAFL1bkrDbb-mp6Z5u6F_yLMCp3mwsl3yc8";
$link1 = "https://api.telegram.org/bot" . $BOT_TOKEN;
$updates = file_get_contents("php://input");
print_r($link1);

$updates = json_decode($updates, true);

$msgID = $updates['message']['from']['id'];
$name = $updates['message']['from']['first_name'];
$text = $updates['message']['text'];
switch ($text) {
    case "/start":
        sendMsg($msgID, "Welcome $msgID");
        break;
    case "hello":
        sendMsg($msgID, "Hello $msgID");
        break;
    default:
        sendMsg($msgID, "Sorry $msgID the function does not exits ");
        break;
}
function sendMsg($msgID, $data)
{
    $url = $GLOBALS['link1'] . '/sendMessage?chat_id=' . $msgID . '&text=' . urlencode($data);
    $updates = file_get_contents($url);
    print_r($updates);
}
// $patameters = array(
//     "chat_id" => "1532300866",
//     "test" => "Hello "
// );
// send("sendMessage", $patameters);
// print_r($patameters);
// exit;
// function send($method, $data)
// {
//     global $BOT_TOKEN;
//     $url = "https://api.telegram.org/bot$BOT_TOKEN/$method";

//     if (!$curld = curl_init()) {
//         $curld = curl_init();
//     }
//     curl_setopt($curld, CURLOPT_POST, true);
//     curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
//     curl_setopt($curld, CURLOPT_URL, $url);
//     curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
//     $output = curl_exec($curld);
//     curl_close($curld);
//     print_r($url);
//     return $output;
// }
