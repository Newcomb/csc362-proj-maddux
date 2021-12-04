<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="basic.css">
</head>
<body>
<?php 
// copy and paste this for error
if (!isset($_SESSION)){
    session_start();
}
    //create menu
    include 'menu.php';
    include "res_to_table.php";
    include "del_sel_checkbox.php";
    include "drop_down_options.php";

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

       // copy and paste this for errors
       if(isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as &$err) {
                ?>
                    <p><?php echo $err; ?></p>
                <?php
        }
    }    

    // Insert a pokemon
    if (isset($_POST['pokeName'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertPokemon.sql"));
        $stmt->bind_param('s', htmlspecialchars($_POST['pokeName']));

        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Update a pokemon
    if (isset($_POST['pokeID'])) {
        if(is_numeric($_POST['pokeID'])){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokedexGivenID.sql"));
            $stmt->bind_param('si', htmlspecialchars($_POST['newName']), htmlspecialchars(intval($_POST['pokeID'])));
        } else {
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdatePokedexGivenName.sql"));
            $stmt->bind_param('ss', htmlspecialchars($_POST['newName']), htmlspecialchars($_POST['pokeID'])); 
        }
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Delete all checked items
    if (del_sel_checkbox("pokedex", $sql_path . "/DML/DeletePokemon.sql")) {
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
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
//Print result on page
res_to_table($result, 'managePokedexTable.php');
$conn->close();
?>    
</html>