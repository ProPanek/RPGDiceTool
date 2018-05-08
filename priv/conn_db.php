<?php   
	$connect=mysqli_connect('localhost','username','password','yourdatabasename') or die('błąd połączenia z baza danych');
    mysqli_query($connect,'set names UTF8');	
?>
