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
    include "menu.php";
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

    if(isset($_POST['toggle'])){
        if($_COOKIE['dark_mode'] == FALSE){
            setcookie('dark_mode', TRUE);
        } else {
            setcookie('dark_mode', FALSE);
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }    
        

    if (isset($_POST['SubmitRating'])) {
        // Prepare the delete statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertPokemasterRatings.sql"));
        $stmt->bind_param('iii', $_POST['pokemasterID'], $_POST['moveID'], $_POST['ratings']);
        $stmt->execute();
        header('Location: http://35.193.74.68/team/rateMyServices.php', true, 303);
        die();
    }

    ?>
</head>
<body>
    <h1>Rate My Services</h1>
    <h3>Give new rating</h3>
    <form method="POST" action='rateMyServices.php'>
            <?php drop_down_options('/DML/ViewPokemasters.sql', 0, $sql_path, 'Choose PokemasterID', 'pokemasterID'); ?>
            <?php drop_down_options('/DML/ViewMoves.sql', 0, $sql_path, 'Choose Move ID', 'moveID'); ?>
            <label>Choose star rating</label>
            <select name = ratings>
                <option value = '1'>1</option>
                <option value = '2'>2</option>
                <option value = '3'>3</option>
                <option value = '4'>4</option>
                <option value = '5'>5</option>
            </select>
            <br><br>
            <input type="submit" value="Submit Rating" name="SubmitRating">
        </form>
        
    
    <?php
    // Establish query for getting all current instruments
    $sql_query = "SELECT * FROM rating_counts";
    // Query the database using the select statement
    $result = $conn->query($sql_query);
    //Print result on page
    res_to_table($result, $_SERVER['REQUEST_URI']);
    ?>
</body>
</html>

