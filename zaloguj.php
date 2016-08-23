<?php

$login_post = $_POST['login'];
$password_post = $_POST['password'];

echo $login_post;
echo "<br>";


$host = "localhost";
$user = "root";
$password = "";
$db_name = "navigation";

$connect = new mysqli($host, $user, $password, $db_name);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
            $veryfy_user = "select boot_name, boot_pass from boot where boot_name='$login_post' and boot_pass='$password_post'";
            
          $result = $connect->query($veryfy_user);
           
    if ($result->num_rows == 0) {
           
    echo "not conneteed"; 
    header('location: index.php');
    return;
      }
 else {
  echo "connected";      
 }
           $record_id = $result->fetch_assoc();
          $login_navi = $record_id['name_boot'];
          $password_navi = $record_id['pass_boot'];
            session_start();
         $_SESSION['id'] = $login_navi;
          $_SESSION['pass'] = $password_navi;
         header('location: home.php');
         
mysqli_close($connect);
?>