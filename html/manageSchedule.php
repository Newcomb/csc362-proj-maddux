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
    //create menu
    include 'menu.php';
?>
<?php 
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
    // Get base of sql path
    $sql_path = dirname(__DIR__);

    $config = parse_ini_file($login_path .'/mysql.ini');
    $dbname = 'pokemon_db';
    $conn = new mysqli(
                $config['mysqli.default_host'],
                $config['mysqli.default_user'],
                $config['mysqli.default_pw'],
                $dbname);

    // Insert a move into schedule
    if (isset($_POST['moveName'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertSchedule.sql"));
        $stmt->bind_param('s', $_POST['moveName']);

        $stmt->execute();
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Update a move in schedule
    if (isset($_POST['moveID'])) {
        if(is_numeric($_POST['moveID'])){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleGivenID.sql")); //Need to make SQL for this
            $stmt->bind_param('ii', intval($_POST['newID']), intval($_POST['moveID']));
        } else {
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleGivenName.sql")); //Need to make SQL for this
            $stmt->bind_param('ss', $_POST['newName'], $_POST['moveID']); 
        }
        $stmt->execute();
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    //SIMILAR UPDATE TO ONE ABOVE FOR when_taught; drop down for possible times
    if (isset($_POST['timeID'])) {
        if(is_numeric($_POST['timeID'])){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleTimeGivenID.sql")); //Need to make SQL for this
            $stmt->bind_param('ii', intval($_POST['newID']), intval($_POST['timeID']));
        } else {
            // Prepare the insert statement
            //$stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleGivenName.sql")); //Need to make SQL for this
            //$stmt->bind_param('ss', $_POST['newName'], $_POST['timeID']); 
        }
        $stmt->execute();
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Delete all checked items
    if (del_sel_checkbox("pokedex", $sql_path . "/DML/DeleteSchedule.sql")) {
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


    <h1>Manage Schedule</h1>
    <h3>Add a new Move to Schedule</h3>
        <p>
            <form method=POST>
                <input type=text name=moveName placeholder='Enter name...' required/>
                <input type=submit value='Add New Move to Schedule'/>
            </form>
        </p>
    <h3>Update a schedule Move by Name</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewMoves.sql', 0, $sql_path, 'Choose a Move to Replace', 'moveID'); ?>
                <?php drop_down_options('/DML/ViewMoves.sql', 0, $sql_path, 'Choose a New Move', 'newID'); //not showing; neither is submit?> 
                <input type=submit value='Update Move by ID'/>
            </form>

    <h3>Change when_taught</h3>
            <form method="POST">
                <input type=date name=timeID required/>
                <?php//drop_down_options('/DML/ViewSchedule.sql', 1, $sql_path, 'Choose a Time to Replace','timeID');?>
                <label for=taughtStat>When will the move be taught?</label>
                    <select name=taughtStatNum>
                        <option value=0>Morning</option>
                        <option value=1>Night</option>
                    </select>
                <input type=submit value="Update when_taught"/>
            </form>
</body>
<?php

// Establish query for getting all current instruments
$sql_query =  file_get_contents($sql_path . "/DML/ViewMoveSchedule.sql");
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result,'manageSchedule.php');
$conn->close();
?>    
</html>