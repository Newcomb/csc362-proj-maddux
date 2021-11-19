<?php
ini_set ("display_errors",1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include 'menu.php';
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


// Insert an owned pokemon
if (isset($_POST['Insert'])) {
    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertOwnedPokemon.sql"));
    $stmt->bind_param('ii', $_POST['pokemasterID'], $_POST['pokeID']);
    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

// Update an owned pokemons pokemon id
if (isset($_POST['Update'])) {

    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonPokeID.sql"));
    $stmt->bind_param('ii', intval($_POST['newPokeID']), intval($_POST['ownedPokeID']));
    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}


// Update an owned pokemons pokemaster id
if (isset($_POST['Update2'])){
    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonOwner.sql"));
    $stmt->bind_param('ii', intval($_POST['pokemasterID2']),intval($_POST['ownedPokeID2']));
    $stmt->execute();
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

if (isset($_POST['deleteAll'])){
    $conn->query(file_get_contents($sql_path . "/DML/TruncateOwnedPokemon.sql"));
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

// Delete all checked items
if (del_sel_checkbox("owned_pokemon", $sql_path . "/DML/DeleteOwnedPokemon.sql")) {
    header('Location: http://34.135.39.226/team/manageOwnedPokemonTable.php', true, 303);
    die();
}

 
 ?>
</head>

<?php 
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
<body>
    <?php 
    //create menu
    include 'menu.php';
    ?>
    <?php echo '<p>' . dirname(dirname(__DIR__)) . '</p>'?>
    <h1>Manage Owned Pokemon</h1>
    <h3>Add a new Owned Pokemon</h3>
    <form method="POST" action='manageOwnedPokemonTable.php'>
            <?php drop_down_options('/DML/ViewPokemasters.sql', 0, $sql_path, 'Choose PokemasterID', 'pokemasterID'); ?>
            <?php drop_down_options('/DML/ViewPokedex.sql', 1, $sql_path, 'Choose a PokemonID', 'pokeID'); ?>
            <br><br>
            <input type="submit" value="InsertOwnedPokemon" name="Insert">
        </form>
        
    <h3>Update an existing Owned Pokemon's Pokemon ID</h3>
        <form method="POST" action='manageOwnedPokemonTable.php'>
            <?php drop_down_options('/DML/ViewOwnedPokemon.sql', 0, $sql_path, 'Choose an OwnedPokemonID', 'ownedPokeID'); ?>
            <?php drop_down_options('/DML/ViewPokedex.sql', 1, $sql_path, 'Choose a PokemonID', 'newPokeID'); ?>
            <br><br>
            <input type="submit" value="UpdatePokemonID" name="Update">
        </form>

        <h3>Update an existing Owned Pokemon's Pokemaster</h3>
        <form method="POST" action='manageOwnedPokemonTable.php'> 
            <?php drop_down_options('/DML/ViewOwnedPokemon.sql', 0, $sql_path, 'Choose an OwnedPokemonID', 'ownedPokeID2'); ?>
            <?php drop_down_options('/DML/ViewPokemasters.sql', 0, $sql_path, 'Choose a PokemasterID', 'pokemasterID2'); ?>
            <br><br>
            <input type="submit" value="UpdatePokemasterID" name="Update2">
        </form>





</body>
<?php

// Establish query for getting all current instruments
$sql_query = "SELECT * FROM owned_pokemon_join";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, 'manageOwnedPokemonTable.php');
$conn->close();
?>    
</html>