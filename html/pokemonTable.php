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
                <input type="text" name=pokeID placeholder='Enter pokemon_id...' required>
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
    header('Location: http://34.135.39.226/pokemonTable.php', true, 303);
    die();
}

$host = "localhost";
$user = "newcomb";
$pass = "YoloSwag13";
$dbse = "pokemon_db";

//Open mysqli connection and check for errors
if (!$conn = new mysqli($host, $user, $pass, $dbse)){
    echo "Error: Failed to make a MySQL connection: " . "<br>";
    echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";
    exit;
}

// Insert a pokemon
if (isset($_POST['pokeName'])) {

    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents("InsertPokemon.sql"));
    $stmt->bind_param('s', $_POST['pokeName']);

    $stmt->execute();
    header('Location: http://34.135.39.226/pokemonTable.php', true, 303);
    die();
}

// Update a pokemon
if (isset($_POST['newName'])) {

    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents("UpdatePokedex.sql"));
    $stmt->bind_param('si', $_POST['newName'], $_POST['pokeID']);
    $stmt->execute();
    header('Location: http://34.135.39.226/pokemonTable.php', true, 303);
    die();
}

//Delete all checked items
del_sel_checkbox("pokedex", "DeletePokemon.sql");

// Establish query for getting all current instruments
$sql_query = "SELECT pokemon_id, pokemon_name FROM pokedex";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result);
$conn->close();
?>    
</html>