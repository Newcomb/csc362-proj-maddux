<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
    //create menu
    include 'menu.php';
    include "res_to_table.php";
    include "del_sel_checkbox.php";
    include "drop_down_options.php";
    // Check if cookie has been toggled and reset the page
    if(isset($_POST['toggle'])){
        if($_COOKIE['dark_mode'] == FALSE){
            setcookie('dark_mode', TRUE);
        } else {
            setcookie('dark_mode', FALSE);
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Log in to database using configured file
    $login_path = dirname(dirname(__DIR__));
    
    $config = parse_ini_file($login_path .'/mysql.ini');
    $dbname = 'pokemon_db';
    $conn = new mysqli(
                $config['mysqli.default_host'],
                $config['mysqli.default_user'],
                $config['mysqli.default_pw'],
                $dbname);

    // Get base of sql path
    $sql_path = dirname(__DIR__);

    // Insert a pokemon
    if (isset($_POST['pokeName'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertPokemon.sql"));
        $stmt->bind_param('s', $_POST['pokeName']);

        $stmt->execute();
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Update a pokemon
    if (isset($_POST['pokeID'])) {
        if(is_numeric($_POST['pokeID'])){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokedexGivenID.sql"));
            $stmt->bind_param('si', $_POST['newName'], intval($_POST['pokeID']));
        } else {
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokedexGivenName.sql"));
            $stmt->bind_param('ss', $_POST['newName'], $_POST['pokeID']); 
        }
        $stmt->execute();
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Delete all checked items
    if (del_sel_checkbox("pokedex", $sql_path . "/DML/DeletePokemon.sql")) {
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    //Check if the cookie is set and if not establish the cookie
    if(!isset($_COOKIE['dark_mode'])){
        setcookie('dark_mode', FALSE, time() + (20 * 365 * 24 * 60 * 60));
    }
    //Set style based on cookie
    if ($_COOKIE['dark_mode']){
    ?>
        <link rel="stylesheet" href="darkmode.css">
    <?php
    } else {
    ?>
        <link rel="stylesheet" href="basic.css">
    <?php
    }
    ?>


    <h1>Manage Pokemon</h1>
    <h3>Add a new Pokemon</h3>
        <p>
            <form method=POST>
                <input type=text name=pokeName placeholder='Enter name...' required/>
                <input type=submit value='Add New Pokemon'/>
            </form>
        </p>
    <h3>Update an existing Pokemon by Name</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewPokedex.sql', 1, $sql_path, 'Choose a Pokemon', 'pokeID'); ?>
                <input type=text name=newName placeholder='Enter new name...' required/>
                <input type=submit value='Update Pokemon by Name'/>
            </form>
</body>
<?php

// Establish query for getting all current instruments
$sql_query =  file_get_contents($sql_path . "/DML/ViewPokedex.sql");
// Query the database using the select statement
$result = $conn->query($sql_query);
echo '<p>Pokemon 1-12 unable to delete due to RESTRICT. Will crash page.</p>';
//Print result on page
res_to_table($result, 'managePokemonTable.php');
$conn->close();
?>    
</html>