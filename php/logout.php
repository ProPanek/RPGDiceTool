<?php
session_start();
$login = $_SESSION['user'];
//mysqli_query($conncect,"UPDATE vordmor SET logged_in='0' WHERE login='$login'");
header("Location: ../index.php");
echo "wylogowano";
session_unset();
session_destroy();
?>
