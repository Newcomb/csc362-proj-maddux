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
    // copy and paste this for error
if (!isset($_SESSION)){
    session_start();
}
 // copy and paste this for errors
 if(isset($_SESSION['error'])) {
    foreach ($_SESSION['error'] as &$err) {
            ?>
                <p><?php echo $err; ?></p>
            <?php
    }
}  

    // Insert a move into schedule  , $_POST['duration'], $_POST['offered']
    // FOR SOME REASON USING htmlspecialchars and intval here also calls for a notice even though it works 
    
    if (isset($_POST['Insert'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertSchedule.sql"));
        $stmt->bind_param('isi', htmlspecialchars(intval($_POST['moveID'])), htmlspecialchars($_POST['dateTaught']), htmlspecialchars(intval($_POST['timeTaught'])));
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        $reload = true;
    }

    // Update a move in schedule
    if (isset($_POST['Update'])) { 
        if(is_numeric($_POST['moveID'])){
            //as long as scheduleID is unique (none with same id)
            if($_POST['scheduleID']) { 
            // Prepare the insert statement
            $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleGivenID.sql")); 
            $stmt->bind_param('ii', htmlspecialchars(intval($_POST['moveID'])), htmlspecialchars(intval($_POST['scheduleID']))); //something wrong with scheduleID
            }
        } 
        $stmt->execute();
        $reload = true;
    }

    //Update date & time taught
    if (isset($_POST['Update2'])) {
            // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleDateGivenID.sql")); //Need to make SQL for this
        $stmt->bind_param('si', htmlspecialchars($_POST['dateTaught']), htmlspecialchars(intval($_POST['schedID'])));
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        $reload = true;
    }

    // if (isset($_POST['Update3'])) {
    //     if(is_numeric($_POST['timeTaught'])){
    //         // Prepare the insert statement
    //         $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateScheduleTimeGivenID.sql")); 
    //         $stmt->bind_param('ii', intval($_POST['moveID']), intval($_POST['timeTaught']));
    //     } 
    //     $stmt->execute();
    //     $reload = true;
    // }

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

                <div>What day will the move be taught? <input type=date name=dateTaught required/></div> 

                <label for=timeTaught>When will the move be taught?</label>
                    <select name=timeTaught>
                        <option value=0>Morning</option>
                        <option value=1>Night</option>
                    </select>

                <!-- <label for=duration>How long will it take to teach?</label>
                    <select name=duration>
                        <option value=1>1 hr</option>
                        <option value=2>2 hrs</option>
                        <option value=3>3 hrs</option>
                        <option value=4>4 hrs</option>
                    </select>
                
                <label for=offered>Is the move currently offered?</label>
                <select name=offered>
                    <option value=1>Yes</option>
                    <option value=0>No</option> -->
                </select>
                <br>
                <input type=submit value='Add New Move to Schedule' name='Insert'/>
            </form>
        </p>
    
    <h3>Update a scheduled Move</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewSchedule.sql', 0, $sql_path, 'Choose a schedule_id to Replace', 'scheduleID'); //THIS IS CAUSING PROBLEMS?>
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a New Move', 'moveID'); ?> 
                <br>
                <input type=submit value='Update Move by ID' name='Update'/>
            </form>

    <h3>Change when a Move is taught</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewSchedule.sql', 0, $sql_path, 'Choose a schedule_id to Replace', 'schedID'); //THIS IS CAUSING PROBLEMS?>
               <div>What day will the move be taught? <input type=date name=dateTaught required/></div>
                <!-- <?php //drop_down_options('/DML/ViewSchedule.sql', 3, $sql_path, 'Choose a Time to Replace','timeTaught');?>
                <label for=timeTaught>What time will the move be taught?</label>
                    <select name=timeTaught>
                        <option value=0>Morning</option>
                        <option value=1>Night</option>
                    </select> -->
                <br>
                <input type=submit value="Update when taught" name='Update2'/>
            </form>
</body>
<?php

// Establish query for getting all current instruments
$sql_query =  "SELECT * FROM schedule_join";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>