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
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertPokemonTypes.sql"));
    $stmt->bind_param('ii', $_POST['pokemonID'], $_POST['typeID']);
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
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokemasterFirstName.sql"));
    $stmt->bind_param('si', htmlspecialchars($_POST['firstName2']), $_POST['pokemasterID']);
    if(!$stmt->execute()){
        $error_array = array('Error(s):');
        array_push($error_array, $conn->error);
        $_SESSION['error'] = $error_array;
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}


/*
if (isset($_POST['deleteAll'])){
    $conn->query(file_get_contents($sql_path . "/DML/TruncateOwnedPokemon.sql"));
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}
*/
// Delete all checked items
if (del_sel_checkbox("pokemon_types", $sql_path . "/DML/DeletePokemonTypes.sql")) {
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

 
 ?>
</head>
<body>
    <?php 
    ?>
    <h1>Manage Pokemon Types</h1>
    <h3>Add a new Pokemon Type Combination</h3>
    <form method="POST" action='managePokemonTypesTable.php'>
    <?php drop_down_options('/DML/ViewPokedex.sql', 1, $sql_path, 'Choose a Pokemon', 'pokemonID'); ?>
    <?php drop_down_options('/DML/ViewTypes.sql', 1, $sql_path, 'Choose a Type', 'typeID'); ?>
            <br><br>
            <input type="submit" value="InsertPokemaster" name="Insert">
        </form>
        
    <!-- <h3>Update Pokemon Type Combo</h3>
        <form method="POST" action='managePokemonTypesTable.php'>
            <?php drop_down_options('/DML/ViewPokemasters.sql', 0, $sql_path, 'Choose a Pokemaster ID', 'pokemasterID'); ?>
            <input type=text name=firstName2 placeholder='Enter first name...' required/>
            <br><br>
            <input type="submit" value="UpdateFirstName" name="Update">
        </form>
-->



</body>
<?php

// Establish query for getting all current instruments
$sql_query = file_get_contents($sql_path . "/DML/ViewPokemonTypes.sql");
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, 'managePokemonTypesTable.php');
$conn->close();
?>    
</html>