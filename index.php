<?php
@session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Cache-control" content="public">
    <meta author="ProPanek">
    <title>Wybudzenie Tool</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="art/favicon.ico" type="image/x-icon">
    <link rel="icon" href="art/favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="logowanie/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Metal+Mania" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="js/engine.js"></script>
    <script type="text/javascript" src="js/helpers.js"></script>
    <script type="text/javascript" src="js/Ui.js"></script>
    <script type="text/javascript" src="js/Net.js"></script>
    <script type="text/javascript" src="js/Dice.js"></script>
    <script src="logowanie/logowanie.js"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css"
    />
    <link href="css/colors.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="loader/loader.css">

</head>
<script language="javascript" type="text/javascript">
    $(window).on("load", function () {
        $(".sweet-alert").css('background-color', '#000');
        setTimeout(function () {
            document.getElementById("loader-background").style.opacity = "0.0";
            document.getElementById("loader-content").style.transform = "scale(2.0)";
            setTimeout(function () {
                // document.getElementById("loader-background").style.zIndex = "-99999999";
                $(".loader-background").hide()
            }, 1200);
        }, 1000);
    });
</script>

<?php if (isset($_SESSION['user'])) { ?>

<body style="width: 100%; height: 100%;">
    <div class="loader-background" id="loader-background">
        <div class="loader-content" id="loader-content">
            <center>
                <img src="loader/loader-logo.png" />
            </center>
            <div class="loader-loading"></div>
        </div>
    </div>
    <h1>
        <img src="loader/loader-logo.png" alt="" srcset="" style="max-height:100px;">
    </h1>

    <?php include_once"priv/header.php" ?>
    <button id="sidenavbt">Poradniki/księgi</button>
    <button id="closeiframe" style="font-size: 25px;">X</button>
    <div id="sidenav" class="sidenav">
        <button id="sidenavbtclose" style="font-size: 25px;">X</button>
        <select id="book_category">
            <option value="poradniki">poradniki</option>
            <option value="lorebooki">lorebooki</option>
        </select>
    </div>
    <iframe id="iframebook" class="iframebook" src=""></iframe>
    <div id="flex_2">
        <button id="btn_umiejetnosci" type="button" name="button">Umiejętności</button>
        <button id="btn_walka" type="button" name="button">Walka</button>
        <button id="btn_zbroja" type="button" name="button">Zbroja</button>
    </div>
    <div id="flex_wyn">
        <div id="avatar_postaci" class="hover">
            <div style="z-index: -10;">Kliknij aby dodać avatar postaci</div>

        </div>
        <div id="wynik_kosci" class="hover"></div>
        <div id="wynik_kosci_k20" class="hover"></div>
        <div id="dodatki" class="hover">
            <table>
                <tr>
                    <th>Przebicie pancerza</th>
                    <th>Bonus od rzutu</th>
                    <th>Bonus do ofensywy</th>
                    <th>Bonus do defensywy</th>
                </tr>
                <tr>
                    <td>
                        <div class="dodatki">
                            <label>
                                <input id="mod_z" type="number" name="umiejętność"> </label>
                        </div>
                    </td>
                    <td>
                        <div class="dodatki">
                            <label>
                                <input id="mod_r" type="number" name="umiejętność"> </label>
                        </div>
                    </td>
                    <td>
                        <div class="dodatki">
                            <label>
                                <input id="mod_w" type="number" name="umiejętność"> </label>
                        </div>
                    </td>
                    <td>
                        <div class="dodatki">
                            <label>
                                <input id="mod_d" type="number" name="umiejętność"> </label>
                        </div>
                    </td>
                </tr>
            </table>
            <div id="custom_dice" class="hover">
                <input id="dice_counter" type="text" placeholder="ilosc_kosci">
                <input id="dot_counter" type="text" placeholder="ilosc_oczek">
                <button id="custom">Custom</button>
                <button id="1k100">1k100</button>
            </div>
        </div>
    </div>

    <div id="flex_umiejetnosci" style="display:flex;">
        <div id="lista_um" class="hover lotrzyk">
            <span>Drzewo Agenta:</span>
            <hr>
            <div class="stat zr">
                <label>Skradanie:
                    <input id="skradanie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Ukrywanie:
                    <input id="ukrywanie_sie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Kradzież:
                    <input id="kieszonkostwo" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Przetrwanie :
                    <input id="przetrwanie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Pilotaż:
                    <input id="pilotaz" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat wyt">
                <label>Spr. Fizyczna:
                    <input id="spr_fizyczna" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>

        </div>
        <div id="lista_um" class="hover lowca">
            <span>Drzewo Inżyniera:</span>
            <hr>
            <div class="stat zr">
                <label>Tw. gen. osłon:
                    <input id='tw_gen_oslon' type='number' name='umiejętność'>
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Tw. broni dyst.:
                    <input id="tw_broni_dyst" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Jubilerstwo:
                    <input id="jubilerstwo" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat sil">
                <label>Tw. broni białej:
                    <input id="tw_broni_białej" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat sil">
                <label>Tw. pancerzy:
                    <input id="tw_pancerzy" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat zr">
                <label>Tech. odzysku:
                    <input id="tech_odzysku" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
        </div>
        <div id="lista_um" class="hover artysta">
            <span>Drzewo Survivalu:</span>
            <hr>
            <div class="stat zmy">
                <label>Percepcja:
                    <input id="percepcja" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat zmy">
                <label>Tropienie:
                    <input id="tropienie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat zr">
                <label>Obrabianie zw.:
                    <input id="obrabianie_zw" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat sil">
                <label>Górnictwo:
                    <input id="gornictwo" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat int">
                <label>Znajomość zw.:
                    <input id="znajomosc_zw" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat int">
                <label>Tresura:
                    <input id="tresura" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>

        </div>
        <div id="lista_um" class="hover dyplomata">
            <span>Drzewo Dyplomaty:</span>
            <hr>
            <div class="stat cha">
                <label>Zastraszenie:
                    <input id="zastraszenie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat cha">
                <label>Retoryka:
                    <input id="retoryka" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat cha">
                <label>Blefowanie:
                    <input id="blefowanie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat cha">
                <label>Śpiewanie:
                    <input id="spiewanie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat int">
                <label>Granie na inst.:
                    <input id="granie_na_inst" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat cha">
                <label>Dowodzenie:
                    <input id="dowodzenie" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>
            <div class="stat cha">
                <label>Języki:
                    <input id="predyspozycje_j" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number"> </div>

        </div>
        <div id="lista_um" class="hover zaklinacz">
            <span>Drzewo Naukowca:</span>
            <hr>
            <div class="stat int">
                <label>Informatyka:
                    <input id="informatyka" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Biologia:
                    <input id="biologia" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Chemia:
                    <input id="chemia" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Archeologia:
                    <input id="archeologia" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Astrologia:
                    <input id="astrologia" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Medycyna:
                    <input id="medycyna" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>
            <div class="stat int">
                <label>Inżynier:
                    <input id="inzynier" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>


        </div>
        <div id="lista_um" class="hover rzemieslnik">
            <span>Drzewo Dziwnych Ludzi:</span>
            <hr>
            <div class="stat wol">
                <label>Rytuały:
                    <input id="rytualy" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number">
            </div>

        </div>

    </div>
    <div id="staty" class="hover">
        <span>Atrybuty:</span>
        <hr>
        <div class="stat def">
            <label>Sila:
                <input id="sila" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Zrecznosc:
                <input id="zrecznosc" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Inteligencja:
                <input id="inteligencja" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Wytrzymałość:
                <input id="wytrzymalosc" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Wola:
                <input id="wola" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Charyzma:
                <input id="charyzma" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
        <div class="stat def">
            <label>Zmysły:
                <input id="zmysly" type="number" name="umiejętność">
            </label>
            <button>Rzuć</button>
            <input class="mod_suc" type="number">
        </div>
    </div>
    <div id="flex_walka" style="">

        <div id="lista_magii" class="hover" style="flex:1;">
            <span>Moc: </span>
            <hr>
            <div class="magia int" id="jasna">
                <label>Jasna strona mocy:
                    <input id="jasna_strona_mocy" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number" placeholder="k100">
                <input class="mod_wal" type="number" placeholder="k20">
            </div>
            <div class="magia int" id="ciemna">
                <label>Ciemna strona mocy:
                    <input id="ciemna_strona_mocy" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number" placeholder="k100">
                <input class="mod_wal" type="number" placeholder="k20">
            </div>
            <div class="magia int" id="neutralna">
                <label>Neutralna strona mocy:
                    <input id="neutralna_strona_mocy" type="number" name="umiejętność">
                </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number" placeholder="k100">
                <input class="mod_wal" type="number" placeholder="k20">
            </div>

        </div>
        <div id="lista_walki" class="hover">
            <span>Walka bezpośrednia: </span>
            <hr>
            <table>
                <tr>

                    <th>Broń</th>

                    <th>1H</th>

                    <th>2H</th>
                    <th>Parowanie</th>
                </tr>
                <tr>
                    <td>
                        <label>Miecz świetlny (SIŁ): </label>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label>
                                <input id="miecz_h1" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka sil def">
                            <label>
                                <input id="miecz_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Miecz świetlny (ZR): </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="sztylet_h1" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="sztylet_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Podwójny miecz świetlny : </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="mloty_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="mloty_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Podwójne wibroostrze: </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="topory_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="topory_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Dwa miecze świetlne: </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="b_nietypowe_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="b_nietypowe_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Dwa wibroostrza: </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label> - </label>
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="kostury_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="kostury_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>B. Nietypowa (SIŁ): </label>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label>
                                <input id="wlocznie_h1" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label>
                                <input id="wlocznie_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil def">
                            <label>
                                <input id="wlocznie_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>B. Nietypowa (ZR): </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="piesci" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="wlocznie_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="piesci_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Broń długa (ZR): </label>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="piesci" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr at">
                            <label>
                                <input id="wlocznie_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka zr def">
                            <label>
                                <input id="piesci_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Broń długa (SIŁ): </label>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label>
                                <input id="piesci" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil at">
                            <label>
                                <input id="wlocznie_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka sil def">
                            <label>
                                <input id="piesci_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Walka bez broni: </label>
                    </td>
                    <td>
                        <div class="walka wyt at">
                            <label>
                                <input id="piesci" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka wyt at">
                            <label>
                                <input id="wlocznie_h2" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="walka wyt def">
                            <label>
                                <input id="piesci_par" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_suc" type="number" placeholder="k100">
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Unik: </label>
        </div>
        </td>
        <td>
            <div class="walka zr null" class="hover">
                <label>
                    <input id="uniki" type="number" name="umiejętność"> </label>
                <button>Rzuć</button>
                <input class="mod_suc" type="number" placeholder="k100">
                <input class="mod_wal" type="number" placeholder="k20">
            </div>
        </td>
        </tr>
        </table>

    </div>

    <div id="lista_walki_1" class="hover">
        <span>Walka dystansowa: </span>
        <hr>
        <table>
            <tr>

                <th>Broń</th>

                <th>1H</th>

                <th>2H</th>
                <th>Parowanie</th>
            </tr>
            <tr>
                <td>
                    <label>B. Miotana: (SIŁ) </label>
                </td>
                <td>
                    <div class="walka sil at">
                        <label>
                            <input id="b_miotana_h1" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka sil at">
                        <label> - </label>
                    </div>
                </td>
                <td>
                    <div class="walka sil def">
                        <label>
                            <input id="b_miotana_par" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Blastery (ZR) </label>
                </td>
                <td>
                    <div class="walka zr at">
                        <label>
                            <input id="b_miotana_h1" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka zr at">
                        <label>
                            <input id="b_miotana_h1" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka zr def">
                        <label>
                            <input id="b_miotana_par" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Blastery (ZMY) </label>
                </td>
                <td>
                    <div class="walka zmy at">
                        <label>
                            <input id="b_miotana_h1" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka zmy at">
                        <label>
                            <input id="b_miotana_h1" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka zmy def">
                        <label>
                            <input id="b_miotana_par" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Ciężkie Blastery (SIŁ): </label>
                </td>
                <td>
                    <div class="walka sil at">
                        <label> - </label>
                    </div>
                </td>
                <td>
                    <div class="walka sil at">
                        <label>
                            <input id="luki_h2" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka sil def">
                        <label>
                            <input id="luki_par" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Blaster snajperski (ZMY): </label>
                </td>
                <td>
                    <div class="walka zmy at">
                        <label> - </label>
                    </div>
                </td>
                <td>
                    <div class="walka zmy at">
                        <label>
                            <input id="kusze_h2" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>
                <td>
                    <div class="walka zmy def">
                        <label>
                            <input id="kusze_par" type="number" name="umiejętność"> </label>
                        <button>Rzuć</button>
                        <input class="mod_suc" type="number" placeholder="k100">
                        <input class="mod_wal" type="number" placeholder="k20">
                    </div>
                </td>

            </tr>
        </table>
    </div>
    </div>
    <div id="notatnik">
        <pre id="notatnik_pre">Notatnik</pre>
    </div>
    <div id="flex_1">
        <div id="zbroja" class="hover">
            <span>Tors:</span>
            <table>
                <tr>
                    <th>Sieczne i kłute</th>
                    <th>Kinetyczne</th>
                    <th>Energetyczne</th>
                    <th>Błyskawice</th>
                    <th>Termiczne</th>
                    <th>Kriogeniczne</th>
                    <th>Uniki</th>
                </tr>
                <tr>

                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ciecia" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="obuch" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="pociski" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="blyskawice_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ogien_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="lodiwoda_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="refleks_z" type="number" name="umiejętność"> </label>
                        </div>
                    </td>
                </tr>

            </table>
            <span>Rękawice:</span>
            <table>
                <tr>
                    <th>Sieczne i kłute</th>
                    <th>Kinetyczne</th>
                    <th>Energetyczne</th>
                    <th>Błyskawice</th>
                    <th>Termiczne</th>
                    <th>Kriogeniczne</th>
                </tr>
                <tr>

                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ciecia" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="obuch" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="pociski" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="blyskawice_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ogien_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="lodiwoda_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>

            </table>
            <span>Buty:</span>
            <table>
                <tr>
                    <th>Sieczne i kłute</th>
                    <th>Kinetyczne</th>
                    <th>Energetyczne</th>
                    <th>Błyskawice</th>
                    <th>Termiczne</th>
                    <th>Kriogeniczne</th>
                </tr>
                <tr>

                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ciecia" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="obuch" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="pociski" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="blyskawice_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ogien_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="lodiwoda_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>

            </table>
            <span>Spodnie:</span>
            <table>
                <tr>
                    <th>Sieczne i kłute</th>
                    <th>Kinetyczne</th>
                    <th>Energetyczne</th>
                    <th>Błyskawice</th>
                    <th>Termiczne</th>
                    <th>Kriogeniczne</th>
                </tr>
                <tr>

                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ciecia" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="obuch" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="pociski" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="blyskawice_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ogien_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="lodiwoda_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                </tr>

            </table>
            <span>Hełm:</span>
            <table>
                <tr>
                    <th>Sieczne i kłute</th>
                    <th>Kinetyczne</th>
                    <th>Energetyczne</th>
                    <th>Błyskawice</th>
                    <th>Termiczne</th>
                    <th>Kriogeniczne</th>

                </tr>
                <tr>

                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ciecia" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="obuch" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="pociski" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="blyskawice_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="ogien_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>
                    <td>
                        <div class="zbroja">
                            <label>
                                <input id="lodiwoda_z" type="number" name="umiejętność"> </label>
                            <button>Rzuć</button>
                            <input class="mod_wal" type="number" placeholder="k20">
                        </div>
                    </td>

                </tr>

            </table>
        </div>


    </div>
    <footer class="hover">code & css: ProPanek (2016-2018)</footer>
</body>
<?php
} else {
?>

    <body style="width: 100%; height: 100%;">
        <script>
        $(document).keypress(function(e) {
            if(e.which == 13) {
                 const data = {
                login: $("#login").val(),
                password: $("#password").val()
            }
            Net.login(data, "php/psswd.php")
            }
        });
           
        </script>
        <div class="loader-background" id="loader-background">
            <div class="loader-content" id="loader-content">
                <center>
                    <img src="loader/loader-logo.png" />
                </center>
                <div class="loader-loading"></div>
            </div>
        </div>
        <video autoplay muted loop id="myVideo">
            <source src="logowanie/video1.mp4" type="video/mp4">
        </video>
        <div class="content">
            <div class="box-logowanie" id="box-logowanie">


                <center>
                    <img src="loader/loader-logo.png" />
                </center>
                <p>Login:</br>
                    <input type="text" name="login" id="login">
                </p>
                <p>Hasło:</br>
                    <input type="password" name="pass" id="password">
                </p>
                <p style="margin-bottom: 0;">
                    <center>
                        <input id="zaloguj_btn" type="button" value="Zaloguj sie" style="width: 100px; margin-right: 20px; text-align: center;">
                        <input onclick="setrejestracja();" type="button" value="Rejestracja" style="width: 100px; text-align: center;">
                    </center>
                </p>
            </div>
            <div class="box-rejestracja" id="box-rejestracja">
                <p style="margin-top: 0;">Login:</br>
                    <input type="text" name="login" id="login_register">
                </p>
                <p>Hasło:</br>
                    <input type="password" name="login" id="password_register">
                </p>
                <p>Potwierdź Hasło:</br>
                    <input type="password" name="login" id="password_r_register">
                </p>
                <p>E-mail:</br>
                    <input type="email" name="login" id="email_register">
                </p>
                <p>Potwierdź e-mail:</br>
                    <input type="email" name="login" id="email_r_register">
                </p>
                <p style="margin-bottom: 0;">
                    <center>
                        <input id="zarejestruj_btn" type="button" value="Zarejestruj" style="width: 100px; margin-right: 20px; text-align: center;">
                        <input onclick="setlogowanie()" type="button" value="Logowanie" style="width: 100px; text-align: center;">
                    </center>
                </p>
            </div>
        </div>
    </body>
    <?php 
  }
?>

</html>