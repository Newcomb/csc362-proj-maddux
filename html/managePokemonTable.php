<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
    include "res_to_table.php";
    include "del_sel_checkbox.php";
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
</head>
<body>
    <h1>Manage Pokemon</h1>
    <h3>Add a new Pokemon</h3>
        <p>
            <form method=POST>
                <input type=text name=pokeName placeholder='Enter name...' required/>
                <input type=submit value='Add New Pokemon'/>
            </form>
        </p>
    <h3>Update an existing Pokemon</h3>
        <p>
            <form method="POST">
                <input type="text" name=pokeID placeholder='Enter old name...' required>
                <input type=text name=newName placeholder='Enter new name...' required/>
                <input type=submit value='Update Pokemon'/>
            </form>
        </p>
</body>
<?php

// Check if cookie has been toggled and reset the page
if(isset($_POST['toggle'])){
    if($_COOKIE['dark_mode'] == FALSE){
        setcookie('dark_mode', TRUE);
    } else {
        setcookie('dark_mode', FALSE);
    }
    header('Location: http://34.135.39.226/team/managePokemonTable.php', true, 303);
    die();
}

// Log in to database using configured file
$login_path = dirname(dirname(__DIR__));
echo dirname(__DIR__);

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
    header('Location: http://34.135.39.226/team/managePokemonTable.php', true, 303);
    die();
}

// Update a pokemon
if (isset($_POST['newName'])) {

    // Prepare the insert statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokedex.sql"));
    $stmt->bind_param('ss', $_POST['newName'], $_POST['pokeID']);
    $stmt->execute();
    header('Location: http://34.135.39.226/team/managePokemonTable.php', true, 303);
    die();
}

// Delete all checked items
if (del_sel_checkbox("pokedex", $sql_path . "/DML/DeletePokemon.sql")) {
    header('Location: http://34.135.39.226/team/managePokemonTable.php', true, 303);
    die();
}



// Establish query for getting all current instruments
$sql_query = "SELECT pokemon_id AS PokemonName FROM pokedex";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, 'managePokemonTable.php');
$conn->close();
?>    
</html>