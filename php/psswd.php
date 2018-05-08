<?php
session_start();
function haslo(){

    $login = $_POST['login'];
    $password = $_POST['password'];


    include_once "../priv/conn_db.php";

    $respond_all =mysqli_query($connect,"SELECT * FROM users WHERE login='$login'") or die('nie mozna pobrac rekordow z tabeli1');

    $rec_all = mysqli_fetch_array($respond_all);
    if ($rec_all == null) {
        http_response_code(403);
        die('błędny login');
    }
    $database_login = $rec_all['login'];
    $database_password = $rec_all['password'];
    $database_access = $rec_all['access'];
    $database_admin = $rec_all['admin'];
    mysqli_close($connect);

    $accept = password_verify($password,$database_password);

    if($login == null || $password == null){
            http_response_code(403);
            echo "brak loginu lub hasła";
        }
    else if($accept && $database_access == 1 && $database_admin == 1){
                $_SESSION['admin'] = $login;
                $_SESSION['user'] = $login;
                echo "Witaj Szefie, kawka, herbata?";
    }
    else if($accept && $database_access == 1){

                $_SESSION['user'] = $login;
                echo "zalogowano";
       }
    else if($accept && $database_access == 0){
        http_response_code(403);
                echo "konto nie jest jeszcze aktywne, poczekaj na akceptacje przez administratora";
        }
    else{
        http_response_code(403);
                echo "nie zalogowałeś się, błędny login lub hasło";
    }
}
haslo();
?>
