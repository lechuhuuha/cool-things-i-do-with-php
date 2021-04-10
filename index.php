<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
try{
   $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
   $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
   die('Unable to connect with the database');
}
// Encrypt cookie
function encryptCookie( $value ) {

    $key = hex2bin(openssl_random_pseudo_bytes(4));
 
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
 
    $ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);
 
    return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
 }
 
 // Decrypt cookie
 function decryptCookie( $ciphertext ) {
 
    $cipher = "aes-256-cbc";
 
    list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
    return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
 
 }
 
 // Check if $_SESSION or $_COOKIE already set
 if( isset($_SESSION['userid']) ){
    header('Location: home.php');
    exit;
 }else if( isset($_COOKIE['rememberme'] )){
 
    // Decrypt cookie variable value
    $userid = decryptCookie($_COOKIE['rememberme']);
 
    // Fetch records
    $stmt = $conn->prepare("SELECT count(*) as cntUser FROM users WHERE id=:id");
    $stmt->bindValue(':id', (int)$userid, PDO::PARAM_INT);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();
 
    if( $count > 0 ){
       $_SESSION['userid'] = $userid; 
       header('Location: home.php');
       exit;
    }
 }
 
 // On submit
 if(isset($_POST['but_submit'])){
 
    $username = $_POST['txt_uname'];
    $password = $_POST['txt_pwd'];
 
    if ($username != "" && $password != ""){
 
      // Fetch records
      $stmt = $conn->prepare("SELECT count(*) as cntUser,id FROM users WHERE username=:username and password=:password ");
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute(); 
      $record = $stmt->fetch(); 
 
      $count = $record['cntUser'];
 
      if($count > 0){
         $userid = $record['id'];
 
         if( isset($_POST['rememberme']) ){
 
            // Set cookie variables
            $days = 30;
            $value = encryptCookie($userid);
 
            setcookie ("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1000)); 
         }
 
         $_SESSION['userid'] = $userid; 
         header('Location: home.php');
         exit;
     }else{
         echo "Invalid username and password";
     }
 
   }
 
 }

?>

<!doctype html>
<html>
  <head>
    <title>Login page with Remember me using PDO and PHP</title>
    <link href="style.css" rel="stylesheet" type="text/css">

  </head>
  <body>
     <div class="container">
       <form method="post" action="">
         <div id="div_login">
            <h1>Login</h1>
            <div>
              <input type="text" class="textbox" name="txt_uname" value="" placeholder="Username" />
            </div>
            <div>
              <input type="password" class="textbox" name="txt_pwd" value="" placeholder="Password"/>
            </div>
            <div>
              <input type="checkbox" name="rememberme" value="1" />&nbsp;Remember Me
            </div>
            <div>
              <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
         </div>
      </form>
    </div>
   </body>
</html>