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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script src="libs/lodash.js"></script>
        <script src="js/config.js"></script>
        <script src="js/Net.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
        <!--<script src="libs/under.js"></script>-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link href="css/colors.css" rel="stylesheet" type="text/css" />
        <script src="libs/sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="libs/sweetalert-master/dist/sweetalert.css">
        <script>
            $("head").append("<link rel='stylesheet' id='extracss' href='css/admin.css' type='text/css' />");
        </script>
    </head>

    <body>
        <?php include_once"priv/header.php" ?>
        <div id="flex_2" class="hover" style="width:100%; padding-top:10px; padding-bottom:10px; padding-left:5px;">
            <div id="helpDiv">
                
            </div>
            <div id="generalStats">
                <p>Atrybuty:</p><button id='addStatGeneral' style='flex:1;'>dodaj atrybut</button><button class='endStatGeneral'>zakończ</button>
            </div>
            <hr>
            <div id="stats_config" style="display: flex;">
                <div>
                    <button id='addStat' style='flex:1;'>dodaj umiejętność</button><button class='endStat'>zakończ</button>
                </div>
                <div id="statTable0" style="flex: 1; width: 20%; border:1px solid blue;" >
                    <input type='text' class='tableName'>
                    <button class="editTable">edytuj</button>
                </div>
            </div>
        </div>
        <div id="flex_2" class="hover" style="width:100%; margin-top: 20px; padding-top:10px; padding-bottom:10px; padding-left:5px;">
           <p>podgląd rezultatu</p>
           <div id="result"></div>
        </div>
        <footer>Made by ProPanek (2016-2018)</footer>
    </body>

    </html>