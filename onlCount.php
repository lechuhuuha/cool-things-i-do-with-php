<?php
$pdo = new PDO('mysql:host=localhost;dbname=test_dump;
charset=utf8', 'root', '');
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
/*
 If you have an user registration script,
 replace $_SESSION['nume'] with the variable in which the user name is stored.
 You can get a free registration script from:  http://coursesweb.net/php-mysql/register-login-script-users-online_s2
*/

// get the user name if it is logged, or the visitors IP (and add the identifier)
$vst_id = '-vst-';         // an identifier to know that it is a visitor, not logged user
$uvon = isset($_SESSION['nume']) ? $_SESSION['nume'] : $_SERVER['SERVER_ADDR'] . $vst_id;

$rgxvst = '/^([0-9\.]*)' . $vst_id . '/i';         // regexp to recognize the rows with visitors
$dt = time();                                    // current timestamp
$timeon = 120;             // number of secconds to keep a user online
$nrvst = 0;                                     // to store the number of visitors
$nrusr = 0;                                     // to store the number of usersrs
$usron = '';                                    // to store the name of logged users


// Define and execute the Delete, Insert/Update, and Select queries
$sqldel = "DELETE FROM `useron` WHERE `dt`<" . ($dt - $timeon);
$sqliu = "INSERT INTO `useron` (`uvon`, `dt`) VALUES ('$uvon', $dt) ON DUPLICATE KEY UPDATE `dt`=$dt";
$sqlsel = "SELECT * FROM `useron`";

// Execute each query
if (!$pdo->query($sqldel)) echo 'Error: ' . $conn->error;
if (!$pdo->query($sqliu)) echo 'Error: ' . $conn->error;
$result = $pdo->query($sqlsel);

// if the $result contains at least one row
if ($result->num_rows > 0) {
    // traverse the sets of results and set the number of online visitors and users ($nrvst, $nrusr)
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if (preg_match($rgxvst, $row['uvon'])) $nrvst++;       // increment the visitors
        else {
            $nrusr++;                   // increment the users
            $usron .= '<br/> - <i>' . $row['uvon'] . '</i>';          // stores the user's name
        }
    }
}

$pdo = null;                 // close the MySQL connection

// the HTML code with data to be displayed
$reout = '<div id="uvon"><h4>Online: ' . ($nrusr + $nrvst) . '</h4>Visitors: ' . $nrvst . '<br/>Users: ' . $nrusr . $usron . '</div>';

// if access from <script>, with GET 'uvon=showon', adds the string to return into a JS statement
// in this way the script can also be included in .html files
if (isset($_GET['uvon']) && $_GET['uvon'] == 'showon') $reout = "document.write('$reout');";

echo $reout;             // output /display the result
