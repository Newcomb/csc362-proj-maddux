<?php
ini_set ("display_errors",1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
    //create menu (this just allows for us to use the functions in these files)
    include 'menu.php';
    include "res_to_table.php";
    include "del_sel_checkbox.php";
    include "drop_down_options.php";


    // Log in to database using configured file (this should be copied in every php page to log in)
    $login_path = dirname(dirname(__DIR__));
    
    $config = parse_ini_file($login_path .'/mysql.ini');
    $dbname = 'pokemon_db';
    $conn = new mysqli(
                $config['mysqli.default_host'],
                $config['mysqli.default_user'],
                $config['mysqli.default_pw'],
                $dbname);

    // Get base of sql path (this should also be copied so that the functions know which folders to access)
    $sql_path = dirname(__DIR__);

    // Insert a move )
    if (isset($_POST['ownedPokeID'])) {
        // Prepare the insert statement ($sql_path was the path we established above and it is concatenated to the string"/DML/InsertMoves...sql which will insert the move)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertForgottenMoves.sql"));
        // siii represents the submission of one string followed by three integers as $_POST['moveName] is string and $_POST['typeID] is an integer as long as the next two
        $stmt->bind_param('ii', $_POST['ownedPokeID'], $_POST['moveID']);
        // executes the prepared statement
        $stmt->execute();
        header('Location: http://34.135.39.226/team/manageForgottenMovesTable.php', true, 303);
        die();
    }

    // Update a known moves move id
    if (isset($_POST['newMoveID'])) {
        // Prepare the update statment (this works just like the insert statement above you just have to change the part of the link in quotes to the sql you want)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateForgottenMoves.sql"));
        // This also works just like the insert above with only si because there are two binded parameters one string and one integer
        $stmt->bind_param('iii', $_POST['newMoveID'], $_POST['ownedPokeID2'], $_POST['moveID2']);
        $stmt->execute();
        header('Location: http://34.135.39.226/team/manageForgottenMovesTable.php', true, 303);
        die();
    }
    
    // THIS DOES NOT WORK AT THE MOMENT IT DELETES ALL MVOES OF A POKEMON
    
    // Delete all checked items
    if (del_sel_checkbox("forgotten_moves", $sql_path . "/DML/DeleteForgottenMoves.sql")) {
        header('Location: http://34.135.39.226/team/manageForgottenMovesTable.php', true, 303);
        die();
    }

    ?>
        <link rel="stylesheet" href="basic.css">

    <h1>Manage Forgotten Moves</h1>
    <h3>Add a Forgotten Move</h3>
        <p>
            <!--
            These are like the forms in all other pages you adjust name values for different posts
            -->
            <form method=POST>
                <?php drop_down_options('/DML/ViewOwnedPokemon.sql', 0, $sql_path, 'Choose an Owned Pokemon', 'ownedPokeID'); ?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID'); ?>
                <input type=submit value='A New Forgotten Move'/>
            </form>
        </p>

        <!--
          Dont know if this will be necessary given you arent supposed to be able to change primary keys
         -->

</body>
<?php

// Establish query for getting all current moves. (I use the view here because it gives data that is useful to the person looking, not just a bunch of numbers)
$sql_query =  "SELECT * FROM forgotten_moves_join";
// The rest of this should just be copy and pasted
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>