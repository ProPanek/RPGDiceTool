<header>
<!-- <script src="libs/sweetalert-master/dist/sweetalert.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="libs/sweetalert-master/dist/sweetalert.css"> -->
 <script>

        <?php if(isset($_SESSION['user'])) {}
        else{?>
            
            <?php }?>
        </script>
    <div id="menu">
        <?php @session_start();  ?>

            <?php if (isset($_SESSION['user'])) { ?>
            <li> Nick: <input  id="login" type="text" value="<?php echo$_SESSION['user']; ?>" style="width: 100px; border-left: 2px solid rgba(22, 8, 7, 0.9);" readonly="readonly" /></li>
            <li><a style="padding-top: 6px; height: 24px;" href="php/logout.php">wyloguj</a></li>
            <?php
                if($_SERVER['PHP_SELF'] == '/karta.php'){
                    echo "<li><a href='/'>kości</a></li>";
                }
                else if($_SERVER['PHP_SELF'] == '/admin.php'){
                    echo "<li><a href='/'>rzuty</a></li>";
                }
                else if($_SERVER['PHP_SELF'] == '/docs.php'){
                    echo "<li><a href='/'>rzuty</a></li>";
                }
                else if($_SERVER['PHP_SELF'] == '/items.php'){
                    echo "<li><a href='/'>rzuty</a></li>";
                }
                else if($_SERVER['PHP_SELF'] == '/kowal.php'){
                    echo "<li><a href='/'>rzuty</a></li>";
                }
                else if($_SERVER['PHP_SELF'] == '/alchemia.php'){
                    echo "<li><a href='/'>rzuty</a></li>";
                }
             ?>
            <!-- <li><button id="zeruj_staty">zeruj</button></li> -->
            <li><button id="wyślij_staty">zapisz</button></li>
            <li><button id="wczytaj_staty">wczytaj</button></li>
            <li><button id="nowa_postac" >nowa postać</button></li>
            <li ><select id="wybierz_postac" >
                <?php
                    include_once"priv/conn_db.php";
                    $login = $_SESSION['user'];
                    $sql = mysqli_query($connect,"SELECT nazwa FROM postacie where get_login='$login' order by nazwa ASC");
                    while ($fetch = mysqli_fetch_assoc($sql)) {
                        echo "<option id='login_pos' value='".$fetch['nazwa']."'>".$fetch['nazwa']."</option>";
                    }
                    mysqli_close($connect);
                ?>
                </select></li>
                <li><button id="usun_postac">usuń postać</button></li>
                <?php } if(isset($_SESSION['admin'])) {
                     if($_SERVER['PHP_SELF'] != '/admin.php'){
                    echo "<li><a style='padding-top: 6px; height: 24px;'' href='/admin.php'>panel admina</a></li>";
                }
                  ?>
                <?php } else if (!isset($_SESSION['user']))
                { ?>
        <li><a class="index" href="index.php">Witaj</a></li>
       
        <?php } ?>
        </ul>
    </div>
    </div>
</header>
