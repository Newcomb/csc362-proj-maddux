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
// copy and paste this for error
if (!isset($_SESSION)){
    session_start();
}
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

    // copy and paste this for errors
    if(isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as &$err) {
                ?>
                    <p><?php echo $err; ?></p>
                <?php
        }
    }    
    
    // Insert a move )
    if (isset($_POST['ownedPokeID'])) {
        // Prepare the insert statement ($sql_path was the path we established above and it is concatenated to the string"/DML/InsertMoves...sql which will insert the move)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertKnownMoves.sql"));
        // siii represents the submission of one string followed by three integers as $_POST['moveName] is string and $_POST['typeID] is an integer as long as the next two
        $stmt->bind_param('ii', $_POST['ownedPokeID'], $_POST['moveID']);
        // executes the prepared statement
        // COPY AND PASTE THIS FOR ERRORS !!!!!!
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        // TO HERE 
        header('Location: http://34.135.39.226/team/manageKnownMovesTable.php', true, 303);
        die();
    }

    // Update a known moves move id
    if (isset($_POST['newMoveID'])) {
        // Prepare the update statment (this works just like the insert statement above you just have to change the part of the link in quotes to the sql you want)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateKnownMoves.sql"));
        // This also works just like the insert above with only si because there are two binded parameters one string and one integer
        $stmt->bind_param('iii', $_POST['newMoveID'], $_POST['ownedPokeID2'], $_POST['moveID2']);
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header('Location: http://34.135.39.226/team/manageKnownMovesTable.php', true, 303);
        die();
    }
    
    // THIS DOES NOT WORK AT THE MOMENT IT DELETES ALL MVOES OF A POKEMON
    
    // Delete all checked items
    if (del_sel_checkbox("known_moves", $sql_path . "/DML/DeleteKnownMoves.sql")) {
        header('Location: http://34.135.39.226/team/manageKnownMovesTable.php', true, 303);
        die();
    }

    ?>
        <link rel="stylesheet" href="basic.css">

    <h1>Manage Known Moves</h1>
    <h3>Add a Known Move</h3>
        <p>
            <!--
            These are like the forms in all other pages you adjust name values for different posts
            -->
            <form method=POST>
                <?php drop_down_options('/DML/ViewOwnedPokemon.sql', 0, $sql_path, 'Choose an Owned Pokemon', 'ownedPokeID'); ?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID'); ?>
                <input type=submit value='Teach a New Move'/>
            </form>
        </p>

        <!--
          Dont know if this will be necessary given you arent supposed to be able to change primary keys
         -->
        <h3>Update an existing Known Moves Move ID</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewOwnedPokemon.sql', 0, $sql_path, 'Choose an OwnedPokemon', 'ownedPokeID2'); ?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose the Move to change', 'moveID2'); ?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a new Move', 'newMoveID'); ?>
                <input type=submit value='Update Moves Name'/>
            </form>


</body>
<?php

// Establish query for getting all current moves. (I use the view here because it gives data that is useful to the person looking, not just a bunch of numbers)
$sql_query =  "SELECT * FROM known_moves_join";
// The rest of this should just be copy and pasted
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>