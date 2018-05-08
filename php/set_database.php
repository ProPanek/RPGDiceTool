<?php 
//setup 
include_once "../priv/conn_db.php";
$action=$_POST['action'];
$action($connect);

//user functions
function set_new_character($connect){
    $character=$_POST['character'];
    $login=$_POST['login'];
    mysqli_query($connect, "INSERT INTO characters (charName, userName) VALUES ('$character','$login')") or die(mysqli_error($connect));
}
function set_save_character($connect){
    $general_stats = json_decode($_POST['general_stats']);
    $fight_stats = json_decode($_POST['fight_stats']);
    $magic_stats = json_decode($_POST['magic_stats']);
    $armor_stats = json_decode($_POST['armor_stats']);
    $character=$_POST['character'];
    $login=$_POST['login'];
    
    $reg = "UPDATE characters SET generalStats = '$general_stats', fightStats = '$fight_stats', magicStats = '$magic_stats', armorStats = '$armor_stats' WHERE userName = '$login' AND charName = '$character'";
       
    mysqli_query($connect,$reg) or die("nie mozna wpisac rekordwo do tabeli1");
}
function set_notes($connect){
		$text = $_POST['text'];
		$text = mysqli_real_escape_string($connect, $text);
		$character = $_POST['character'];
		mysqli_query($connect, "UPDATE characters SET charNotes='$text' WHERE charName='$character'") or die(mysqli_error($connect));
}

function set_avatar($connect){
	$character = $_POST['character'];
	$url = $_POST['url'];
	$query = "UPDATE characters SET avatar='$url' WHERE charName = '$character'";
	mysqli_query($connect, $query) or die(mysqli_error($connect));
}
function set_book($connect){
	$name = $_POST['name'];
	$url = $_POST['url'];
	$category = $_POST['category'];

	$query = "INSERT INTO books VALUES ('','$name', '$category', '$url')";
	mysqli_query($connect, $query) or die(mysqli_error($connect));
	echo "dodałem księge $name";
	
}
//admin function
function set_save_dice($connect){
    $dice =$_POST['dice'];
    $charName=$_POST['charName'];
    $make_dice_table = "CREATE TABLE IF NOT EXISTS dice( ".
    "name VARCHAR(100) , ".
    "value VARCHAR(100) , ".
    "primary key ( name ))";
    mysqli_query($connect,$make_dice_table) or die("nie mozna stworzyc tabeli");
    $reg = "REPLACE INTO dice (name, value) VALUES ('$charName', '$dice')";
    mysqli_query($connect,$reg) or die(mysqli_error($connect));
}
function set_user_access($connect){
	$user = $_POST['user'];
	$reg = "UPDATE users SET access=1 WHERE login='$user' ";
	mysqli_query($connect,$reg) or die(mysqli_error($connect));
	echo "$user otrzymał dostęp";
}
function set_art($connect){
		$wybrana_postac = $_POST['wybrana_postac'];
		$art_link = $_POST['art_link'];
		$reg = "UPDATE characters SET img_tlo='$art_link' WHERE charName='$wybrana_postac' ";
		mysqli_query($connect,$reg) or die(mysqli_error($connect));
		echo "zmieniłem arta postaci $wybrana_postac";
}
?>