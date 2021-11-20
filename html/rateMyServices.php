<?php
ini_set ("display_errors",1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <!--Pokemon Font Link-->
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">    
    <?php
    include "res_to_table.php";
    include "del_sel_checkbox.php";
    include "drop_down_options.php";
    // Log in to database using configured file
    $login_path = dirname(dirname(__DIR__));

    // Get base of sql path
    $sql_path = dirname(__DIR__);
    $config = parse_ini_file($login_path .'/mysql.ini');
    $dbname = 'pokemon_db';
    $conn = new mysqli(
            $config['mysqli.default_host'],
            $config['mysqli.default_user'],
            $config['mysqli.default_pw'],
            $dbname);

    ?>
</head>
<body>
    <?php
    //create menu
    include 'menu.php';
    ?>
    <?php echo '<p>' . dirname(dirname(__DIR__)) . '</p>'?>
    <h1>Rate My Services</h1>
    <h3>Give new rating</h3>
    <form method="POST" action='rateMyServices.php'>
            <?php drop_down_options('/DML/ViewPokemasterRatings.sql', 0, $sql_path, 'Choose Pokemaster ID', 'pokemasterID'); ?> 
            <?php drop_down_options('/DML/ViewPokemasterRatings.sql', 1, $sql_path, 'Choose Move ID', 'moveID'); ?>
            <label>Choose star rating</label>
            <select name = ratings>
                <option value = '1star'>1</option>
                <option value = '2star'>2</option>
                <option value = '3star'>3</option>
                <option value = '4star'>4</option>
                <option value = '5star'>5</option>
            </select>
            <br><br>
            <input type="submit" value="InsertOwnedPokemon" name="Insert">
        </form>

    
    <?php

    ?>
</body>
</html>