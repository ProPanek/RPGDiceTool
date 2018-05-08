<?php   
        
	$login = $_POST['login'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $email = $_POST['email'];

    if (strlen($login) <= 5) {
        die('login jest za krótki, minimalna długość to 5 znaków');
    }
    if (!preg_match("/^[a-zA-Z0-9 ]+$/",$login)) {
        die("tylko duże/małe litery oraz spacje");
    }
    if ($password != $password_repeat) {
    	die('hasła nie pasują do siebie');
    }
    if (strlen($password) <= 8) {
        die('hasło jest za krótkie, minimalna długość to 8 znaków');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('źle wpisany email');
    }    
   
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    include_once "../priv/conn_db.php";

    $respond_all = mysqli_query($connect,"SELECT * FROM users WHERE login='$login' OR email='$email'") or die('nie mozna pobrac rekordow z tabeli1');
    $rec_all = mysqli_fetch_array($respond_all);
    $database_login = $rec_all['login'];
    $database_email = $rec_all['email'];

    if ($login === $database_login) {
        die("Login jest już zajęty");
    }
    if ($email === $database_email) {
        die("email jest już zarejestrowany");
    }

	$reg = "INSERT INTO users (login, password, email , admin) VALUES ('$login', '$hash', '$email', '0')";
 	mysqli_query($connect,$reg) or die('nie mozna wstawic rekordow');

    echo "Wszystko jest w porządku, poproś adma o akceptacje twojego konta";
    mysqli_close($connect);


?>