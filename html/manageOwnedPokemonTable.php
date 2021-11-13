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
    <h1>Manage Owned Pokemon</h1>
    <h3>Add a new Owned Pokemon</h3>
        <p>
            <form method=POST>
                <input type=text name=pokeID placeholder='Enter pokemon_id...' required/>
                <input type="text" name=pokemasterID placeholder='Enter pokemaster_id' required/>
                <input type=submit value='Add New Owned Pokemon'/>
            </form>
        </p>
    <h3>Update an existing Owned Pokemon</h3>
        <p>
            <form method="POST">
                <input type="text" name=ownedPokeID placeholder='Enter owned_pokemon_id...' required>
                <input type=text name=newPokeID placeholder='Enter new pokemon_id...' />
                <input type="text" name=newPokemaster placeholder='Enter pokemaster_id'/>
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
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
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

// Insert an owned pokemon
if (isset($_POST['pokeID'])) {

    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertPokemon.sql"));
    $stmt->bind_param('ii', $_POST['pokemasterID'], $_POST['pokeID']);

    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

// Update an owned pokemons name
if (isset($_POST['newPokeID'])) {

    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonPokeID.sql"));
    $stmt->bind_param('ii', $_POST['newPokeID'], $_POST['ownedPokeID']);
    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

if (isset($_POST['newPokemaster'])){

    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonOwner.sql"));
    $stmt->bind_param('ii', $_POST['newPokemaster'], $_POST['ownedPokeID']);
    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

// Delete all checked items
if (del_sel_checkbox("owned_pokemon", $sql_path . "/DML/DeletePokemon.sql")) {
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}



// Establish query for getting all current instruments
$sql_query = "SELECT owned_pokemon_id, pokemaster_id, pokemon_id FROM owned_pokemon";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, 'manageOwnedPokemonTable.php');
$conn->close();
?>    
</html>