<?php 
//setup 
include_once "../priv/conn_db.php";
$action=$_POST['action'];
$action($connect);
//user function
function check_password($connect){
	$password = $_POST['password'];
	$login = $_POST['login'];

	$respond_all =mysqli_query($connect,"SELECT * FROM users WHERE login='$login'") or die('nie mozna pobrac rekordow z tabeli1');

	$rec_all = mysqli_fetch_array($respond_all);
    if ($rec_all == null) {
        http_response_code(403);
        die('błędny login');
    }

	$database_login = $rec_all['login'];
    $database_password = $rec_all['password'];

	if($database_password == $password ){
		echo "approve";
	}
	else{
		echo "denied";
	}
}
function delete_character($connect){
    $character=$_POST['character'];
    $login=$_POST['login'];

    mysqli_query($connect, "DELETE FROM characters WHERE charName='$character' AND get_login='$login' ") or die(mysqli_error($connect));
}
//admins functions
function delete_book($connect){
	$name = $_POST['name'];

	$query = "DELETE FROM  books WHERE charName = '$name'";
	mysqli_query($connect, $query) or die(mysqli_error($connect));
	echo "usunąłem księge";
	
}
function delete_dice($connect){
    $bt_value = $_POST['bt_value'];
    mysqli_query($connect, "DELETE FROM dice WHERE name='$bt_value'") or die(mysqli_error($connect));
}

function delete_all_dice($connect){
    mysqli_query($connect, "TRUNCATE TABLE dice") or die(mysqli_error($connect));
}
?>