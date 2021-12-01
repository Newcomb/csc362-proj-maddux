<?php
ini_set ("display_errors",1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    // copy and paste this for error
    if (!isset($_SESSION)){
        session_start();
    }
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

// copy and paste this for errors
if(isset($_SESSION['error'])) {
    foreach ($_SESSION['error'] as &$err) {
            ?>
                <p><?php echo $err; ?></p>
            <?php
    }
}    


// Insert an owned pokemon
if (isset($_POST['Insert'])) {
    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertOwnedPokemon.sql"));
    $stmt->bind_param('ii', $_POST['pokemasterID'], $_POST['pokeID']);
    if(!$stmt->execute()){
        $error_array = array('Error(s):');
        array_push($error_array, $conn->error);
        $_SESSION['error'] = $error_array;
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

// Update an owned pokemons pokemon id
if (isset($_POST['Update'])) {

    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonPokeID.sql"));
    $stmt->bind_param('ii', intval($_POST['newPokeID']), intval($_POST['ownedPokeID']));
    if(!$stmt->execute()){
        $error_array = array('Error(s):');
        array_push($error_array, $conn->error);
        $_SESSION['error'] = $error_array;
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}


// Update an owned pokemons pokemaster id
if (isset($_POST['Update2'])){
    // Prepare the update statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateOwnedPokemonOwner.sql"));
    $stmt->bind_param('ii', intval($_POST['pokemasterID2']),intval($_POST['ownedPokeID2']));
    if(!$stmt->execute()){
        $error_array = array('Error(s):');
        array_push($error_array, $conn->error);
        $_SESSION['error'] = $error_array;
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

if (isset($_POST['deleteAll'])){
    $conn->query(file_get_contents($sql_path . "/DML/TruncateOwnedPokemon.sql"));
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

// Delete all checked items
if (del_sel_checkbox("owned_pokemon", $sql_path . "/DML/DeleteOwnedPokemon.sql")) {
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

 
 ?>
</head>


<body>
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