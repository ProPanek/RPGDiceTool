<?php
@session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    http_response_code(403);
    @header("Location: index.php"); // not logged in
    die("Brak dostępu");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="libs/lodash.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/Net.js"></script>
    
    <!--<script src="libs/under.js"></script>-->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <script src="libs/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/sweetalert-master/dist/sweetalert.css">
    <script>
        $("head").append("<link rel='stylesheet' id='extracss' href='css/admin.css' type='text/css' />");
    </script>
</head>
<body>
<?php include_once"priv/header.php" ?>
<div id="flex_2" class="hover" style="width:100%; padding-top:10px; padding-bottom:10px; padding-left:5px;">
    <div id="userDiv">
         Dostęp dla nowego konta:
        <select id='users'>
            <!-- <option id='users_pos' value='".$fetch['login']."'>".$fetch['login']."</option> -->
        </select>
        <button id="access_granted"> przyznaj dostęp </button>
    </div>
   
    <hr>
    Wyniki kości:
    <button id="start_load_dice" >Rozpocznij wczytywanie wyników</button>
    <button id="stop_load_dice" style="display:none;" >Zatrzymaj wczytywanie wyników</button>
    <button id="usun_wyniki" >Usuń wszystkie wyniki</button>
    <label id="info"></label>
    <hr>
    Zmiana tła:
    <select id='gracze'>
    </select>
    link do arta (bezpośredni):<input style="width: 200px;" id="art_target" type="text">
    <button id='change_art'>zmień arta postaci</button>
    <hr>
    Lorebooki i poradniki:
    <br>
    nazwa księgi: <input id="book_name" type="text" name="">
    link do księgi: <input id="book_target" type="text" name="">
    kategoria: 
    <select id="book_category">
        <option value="poradnik">poradnik</option>
        <option value="lorebook">lorebook</option>
    </select>
    <button id="add_book">dodaj księge</button>
    <br>
    Usuwanie księgi: <select id="book_select_delete"></select>
    <button id="delete_book">usuń księge</button>

</div>



<div id="post_here">
</div>
<footer>Made by ProPanek (2016-2018)</footer>
</body>
</html>
