<?php
$pdo = new PDO('mysql:host=localhost;dbname=test_dump;
charset=utf8', 'root', '');
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
// Script Online Users and Visitors - http://coursesweb.net/php-mysql/
if (!isset($_SESSION)) session_start();
$fileTxt = 'useron.txt'; //the file in which the online user are stores
$timeOn = 120; // number of seconds to keep an user online
$sep = '^^';    // characters used to separerate the username and time
$vst_id = '-vst-'; // an indentifier to know which is the loggin user or visistor
include './PhpEnvironment.php';
$remoteAdd = new PhpEnvironment\RemoteAddress();


$uvon = isset($_SESSION['username']) ? $_SESSION['username'] : $remoteAdd->getIpAdress() . $vst_id;

$rgxvst = '/^([0-9\.]*)' . $vst_id . '/i';         // regexp to recognize the line with visitors
$nrvst = 0; // to store the number of the visistors
$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm

// sets the row with the current user /visitor that must be added in $fileTxt(and current TimpStamp) 
$addRow[] = $uvon . $sep . time();
print_r($addRow);


// check if the file from $fileTxt exists and is writable
if (is_writeable($fileTxt)) {

    //get into an array the lines added in $fileTxt
    $ar_rows = file($fileTxt, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Number of rows
    $nrrows = count($ar_rows);

    // If there is at least one line , parse the $ar_rows array
    if ($nrrows > 0) {

        for ($i = 0; $i < $nrrows; $i++) {

            // get each line and separate the user  /visitor and the timestamp
            $ar_line = explode($sep, $ar_rows[$i]);
            echo '<br>';
            print_r($ar_line);
            // add in $addRow array the records in last $timeOn seconds
            if ($ar_line[0] != $uvon && (intval($ar_line[1]) + $timeOn) >= time()) {
                $addRow[] = $ar_rows[$i];
            }
        }
    }
}
$nruvon = count($addRow); // total online


$usron = ''; // to  store the name of logged users

// traverse $addRow to get the number of visitors and users
for ($i = 0; $i < $nruvon; $i++) {
    if (preg_match($rgxvst, $addRow[$i])) $nrvst++;
    else {
        // gets and stores the user's name
        $ar_usron = explode($sep, $addRow[$i]);
        $usron .= '<br> - <i> ' . $ar_usron[0] . '</i>';
    }
}

$nrusr = $nruvon - $nrvst; // gets the users (total - visisitors)

//Html code to display data 
$reout = '<div id="uvon"><h4>Online : ' . $nruvon . '</h4>Visitors : ' . $nrvst . '<br/> Users : ' . $nrusr . $usron . '</div>';

// Write data in $fileTxt
if (!file_put_contents($fileTxt, implode("\n", $addRow))) $reout = 'ERROR : FILE NOTS EXISTED OR NOT WRITEABLE';

// if access from <script>, with GET 'uvon=showon', adds the string to return into a JS statement
// in this way the script can also be included in .html files
if (isset($_GET['uvon']) && $_GET['uvon'] == 'showon') $reout == "document.write('$reout')";
echo $reout;
