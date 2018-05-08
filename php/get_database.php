<?php 
//setup 
include_once "../priv/conn_db.php";
$action=$_POST['action'];
$action($connect);

//user get functions

function get_onload($connect){
    $character=$_POST['character'];
		if ($character == "") {
			echo "/sesja_testing/art/blue_background.jpg";
		}
		else {
			$query = mysqli_query($connect,"SELECT charBackground FROM characters WHERE charName='$character'");
            $result = mysqli_fetch_array($query);
            $background = $result['charBackground'];
            echo $background;
		}

}
function get_notes($connect){
	  $character = $_POST['character'];
	  $query = mysqli_query($connect, "SELECT charNotes FROM characters WHERE charName='$postac'") or die(mysqli_error($connect));
	  $rec = mysqli_fetch_assoc($query);
	  $charNotes = $rec['charNotes'];
	  echo "$charNotes";
}
function get_character_statistics($connect){
    $login=$_POST['login'];
    $character=$_POST['character'];
    $return_arr = array();
    $fetch = mysqli_query($connect, "SELECT generalStats, fightStats, magicStats, armorStats FROM characters WHERE userName = '$login' AND charName = '$character'");
    $rowwal = mysqli_fetch_assoc($fetch);
    echo json_encode($rowwal);
}
function get_user_characters($connect){
    $login = $_POST['login'];
    $array = Array();
    $sql = mysqli_query($connect,"SELECT charName FROM characters WHERE userName='$login' order by charName ASC")  or die("test");
    while ($fetch = mysqli_fetch_assoc($sql)) {
            array_push($array, "<option id='login_pos' value='".$fetch['charName']."'>".$fetch['charName']."</option>");
    }
    echo json_encode($array);
}

function get_avatar($connect){
	$login = $_POST['login'];
	$character = $_POST['character'];
		$query = "SELECT avatar FROM characters WHERE charName = '$character' AND userName='$login'";
		$first_rec = mysqli_query($connect, $query) or die(mysqli_error($connect));
		$result = mysqli_fetch_assoc($first_rec);
		echo json_encode($result);
	
}
function get_books($connect){
	$query = "SELECT nazwa, link, kategoria FROM books ORDER BY nazwa ASC ";
	$sql = mysqli_query($connect, $query) or die(mysqli_error($connect));
	$array = array();
	while ( $fetch = mysqli_fetch_assoc($sql)) {
		$array[] = $fetch;
	}
	echo json_encode($array);
	
}
//admin get functions

function get_dice($connect){
    $return_arr = array();
    $fetch = mysqli_query($connect, "SELECT * FROM dice order by name ASC");
    while ($rowum = mysqli_fetch_array($fetch)) {
        $row_array['name'] = $rowum['name'];
        $row_array['value'] = $rowum['value'];
        array_push($return_arr,$row_array);
    }
    echo json_encode($return_arr);
}

function get_characters($connect){
	$query = "SELECT charName FROM characters ";
	$sql = mysqli_query($connect, $query) or die(mysqli_error($connect));
	$array = array();
	while ( $fetch = mysqli_fetch_assoc($sql)) {
		$array[] = $fetch;
	}
	echo json_encode($array);
	
}
function get_users($connect){
	$query = "SELECT login FROM users WHERE access = '0' ";
	$sql = mysqli_query($connect, $query) or die(mysqli_error($connect));
	$array = array();
	while ( $fetch = mysqli_fetch_assoc($sql)) {
		$array[] = $fetch;
	}
	echo json_encode($array);
	
}
?>