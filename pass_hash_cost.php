<?php
$timeTarget = 0.10;
$cost = 10;
echo '<pre>';

do {
    $cost++;
    $start = microtime(true);
    echo '<br>';

    echo $start;
    echo '<br>';
    password_hash("test", PASSWORD_DEFAULT, ["cost" => $cost]);
    $end = microtime(true);
    echo '<br>';

    echo $end;
    echo '<br>';
    echo $end - $start;
    echo '<br>';
} while (($end - $start) < $timeTarget);
echo 'Appropriate  time : ' . $cost;
// $password = $_POST['p'];
// $hash = '$2y$10$YCFsG6elYca568hBi2pZ0.3LDL5wjgxct1N8w/oLR/jfHsiQwCqTS'; // get this from the database!

// // // The cost parameter can change over time as hardware improves
// // $options = ['cost' => $cost];

// // // Verify stored hash against plain-text password
// // if (password_verify($password, $hash)) {
// //     // Check if a newer hashing algorithm is available
// //     // or the cost has changed
// //     if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options)) {
// //         // If so, create a new hash, and replace the old one
// //         $newHash = password_hash($password, PASSWORD_DEFAULT, $options);
// //         // save $newHash to the database
// //     }

// //     // Log user in

// // }
