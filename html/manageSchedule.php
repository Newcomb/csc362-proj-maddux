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

    //header
    $reload = false;
    if ($reload) {
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        exit();
    } 

    // Insert a move into schedule
    if (isset($_POST['Insert'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertSchedule.sql"));
        echo file_get_contents($sql_path . "/DML/InsertSchedule.sql");
        $stmt->bind_param('isiii', $_POST['moveID'], $_POST['dateTaught'], $_POST['timeTaught'], $_POST['duration'], $_POST['offered']);
        $reload = true;
    }

    // Update a move in schedule
    if (isset($_POST['Update'])) { 
        if(is_numeric($_POST['moveID'])){
            //as long as scheduleID exists
            if($_POST['scheduleID']) { 
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleGivenID.sql")); 
            $stmt->bind_param('ii', intval($_POST['moveID']), intval($_POST['scheduleID'])); 
            }
        } 
        $stmt->execute();
        $reload = true;
    }

    //Update date & time taught
    if (isset($_POST['Update2'])) {
        //date
        if($_POST['dateTaught']){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleDateGivenID.sql"));
            $stmt->bind_param('si', $_POST['dateTaught'], intval($_POST['scheduleID']));
        } 
        $stmt->execute();
        $reload = true;

        //time
        if(is_numeric($_POST['timeTaught'])){
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleTimeGivenID.sql")); 
            $stmt->bind_param('ii', intval($_POST['timeTaught']), intval($_POST['scheduleID']));
        } 
        $stmt->execute();
        $reload = true;
    }

    // Delete all checked items
    if (del_sel_checkbox("schedule", $sql_path . "/DML/DeleteSchedule.sql")) {
        $reload = true;
    }
    ?>

    <h1>Manage Schedule</h1>
    <h3>Add a new Move to schedule</h3>
        <p>
            <form method=POST>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move to add to schedule', 'moveID'); ?>

                <div>What day will the move be taught? <input type=date name=dateTaught required/>

                    <label for=timeTaught>When will the move be taught?</label>
                        <select name=timeTaught>
                            <option value=0>Morning</option>
                            <option value=1>Night</option>
                        </select>

                    <label for=duration>How long will it take to teach?</label>
                        <select name=duration>
                            <option value=1>1 hr</option>
                            <option value=2>2 hrs</option>
                            <option value=3>3 hrs</option>
                            <option value=4>4 hrs</option>
                        </select>
                </div>

                <label for=offered>Is the move currently offered?</label>
                <select name=offered>
                    <option value=1>Yes</option>
                    <option value=0>No</option>
                </select>
                <br>
                <input type=submit value='Add New Move to Schedule' name='Insert'/>
            </form>
        </p>
    
    <h3>Update a scheduled Move</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewSchedule.sql', 0, $sql_path, 'Choose a schedule_id to replace', 'scheduleID');?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a New Move', 'moveID'); ?> 
                <br>
                <input type=submit value='Update Move by ID' name='Update'/>
            </form>

    <h3>Change when a Move is taught</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewSchedule.sql', 0, $sql_path, 'Choose a schedule_id to replace', 'scheduleID');?>
                <br>
                <div>What day will the move be taught? <input type=date name=dateTaught required/>
                    <label for=timeTaught>What time will the move be taught?</label>
                        <select name=timeTaught>
                            <option value=0>Morning</option>
                            <option value=1>Night</option>
                        </select>
                </div>
                <input type=submit value="Update When Taught" name='Update2'/>
            </form>
</body>
<?php

// Establish query for getting all current instruments
$sql_query =  "SELECT * FROM schedule"; //SELECT schedule_id, move_name, type_name, date_taught, time_taught, teaching_duration, offered FROM schedule_join
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>