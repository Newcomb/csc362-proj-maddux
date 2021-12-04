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
    if (isset($_POST['moveName'])) {
        // Prepare the insert statement ($sql_path was the path we established above and it is concatenated to the string"/DML/InsertMoves...sql which will insert the move)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertMoveStatusGiven.sql"));
        // siii represents the submission of one string followed by three integers as $_POST['moveName] is string and $_POST['typeID] is an integer as long as the next two
        $stmt->bind_param('siii', htmlspecialchars($_POST['moveName']), htmlspecialchars(intval($_POST['typeID'])), htmlspecialchars(intval($_POST['hidMoveNum'])), htmlspecialchars(intval($_POST['taughtStatNum'])));
        // executes the prepared statement
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    // Update a moves taught status  
    if (isset($_POST['newMoveName'])) {
        // Prepare the update statment (this works just like the insert statement above you just have to change the part of the link in quotes to the sql you want)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateMoveName.sql"));
        // This also works just like the insert above with only si because there are two binded parameters one string and one integer
        $stmt->bind_param('si', htmlspecialchars($_POST['newMoveName']), htmlspecialchars(intval($_POST['moveID'])));
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }
    
    // Update a moves taught status
    if (isset($_POST['moveID2'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateMoveTaught.sql"));
        $stmt->bind_param('ii', htmlspecialchars(intval($_POST['taughtStatNum2'])), htmlspecialchars(intval($_POST['moveID2'])));
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    /*  THESE COMMENTED OUT UPDATES MESS WITH FOREIGN KEY CONSTRAINTS SO THEY ARE NOT ALLOWED
    Update move hidden status
    if (isset($_POST['moveID3'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateHiddenMoveStatus.sql"));
        $stmt->bind_param('ii', $_POST['hidMoveNum2'], $_POST['moveID3']);
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }
    
    
    // Update move type
    if (isset($_POST['moveID4'])) {
        // Prepare the insert statement
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateMoveTypeID.sql"));
        $stmt->bind_param('ii', $_POST['typeID4'], $_POST['moveID4']);
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }
    */

    // Delete all checked items
    if (del_sel_checkbox("moves", $sql_path . "/DML/DeleteMoves.sql")) {
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        die();
    }

    ?>
        <link rel="stylesheet" href="basic.css">

    <h1>Manage Moves</h1>
    <h3>Add a new Move</h3>
        <p>
            <!--
            These are like the forms in all other pages you adjust name values for different posts
            -->
            <form method=POST>
                <input type=text name=moveName placeholder='Enter move name...' required/>
                <!-- 
                    This creates a drop down for the types
                    The function takes the sql that selects everything from types as the first parameter.
                    Second parameter is the index of the thing you want displayed by the drop down (in this case 0 would be type id and 1 is the type name you can figure this out by looking at the table structure)
                    Third parameter is the label for the dropdown
                    Fourth parameter is the name you want to give the POST (you can see if the form below has been posted by checking isset($_POST['typeID']))
                -->
                <?php drop_down_options('/DML/ViewTypes.sql', 1, $sql_path, 'Choose a Type', 'typeID'); ?>
                <!--
                    Below is a free made drop down that I implemented so that you can submit taught status since it is a 0 or 1 
                    $_POST['taughtStatNum'] is what is used to get the information here
                -->
                <label for=taughtStat>Will the move be taught?</label>
                    <select name=taughtStatNum>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                    </select>
                <!-- This is just lik ethe one above just for hidden move status -->
                <label for=hidMove>Is this a hidden move?</label>
                    <select name=hidMoveNum>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                    </select>
                <input type=submit value='Add New Move'/>
            </form>
        </p>

        <!--
             Now we are into updating the moves table.
            This follows a similar structure to that above, first using a dropdown to select a current move to change the name of it
            followed by a textbox input where you enter the name you want to move to have. These can be accessed by $_POST as well
            The next few follow the same principal as this one and the one above
         -->
        <h3>Update an existing Moves Name</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID'); ?>
                <input type=text name=newMoveName placeholder='Enter new move name...' required/>
                <input type=submit value='Update Moves Name'/>
            </form>

    
    <h3>Update an existing Moves Taught Status</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID2'); ?>
                <label for=taughtStat>Update Teaching Status?</label>
                    <select name=taughtStatNum2>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                    </select>
                <input type=submit value='Update Moves Teaching Status'/>
            </form>
    <!--
    <h3>Update an existing Moves Hidden Move Status</h3>
            <form method="POST">
                <?php //drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID3'); ?>
                <label for=taughtStat>Update Hidden Move Status?</label>
                    <select name=hidMoveNum2>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                    </select>
                <input type=submit value='Update Moves Hidden Status'/>
            </form>

    <h3>Update an existing Moves Type</h3>
            <form method="POST">
                <?php //drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a Move', 'moveID4'); ?>
                <?php //drop_down_options('/DML/ViewTypes.sql', 1, $sql_path, 'Choose a Type', 'typeID4'); ?>
                <input type=submit value='Update Move Type'/>
            </form>
        -->
</body>
<?php

// Establish query for getting all current moves. (I use the view here because it gives data that is useful to the person looking, not just a bunch of numbers)
$sql_query =  "SELECT * FROM moves_types_join";
// The rest of this should just be copy and pasted
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>