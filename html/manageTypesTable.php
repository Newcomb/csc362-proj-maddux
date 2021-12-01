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
    if (isset($_POST['typeName'])) {
        // Prepare the insert statement ($sql_path was the path we established above and it is concatenated to the string"/DML/InsertMoves...sql which will insert the move)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertTypes.sql"));
        // siii represents the submission of one string followed by three integers as $_POST['moveName] is string and $_POST['typeID] is an integer as long as the next two
        $stmt->bind_param('s', $_POST['typeName']);
        // executes the prepared statement
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header('Location: http://34.135.39.226/team/manageTypesTable.php', true, 303);
        die();
    }

    // Update a moves taught status  
    if (isset($_POST['newTypeName'])) {
        // Prepare the update statment (this works just like the insert statement above you just have to change the part of the link in quotes to the sql you want)
        $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/UpdateTypes.sql"));
        // This also works just like the insert above with only si because there are two binded parameters one string and one integer
        $stmt->bind_param('si', $_POST['newTypeName'], $_POST['typeID']);
        if(!$stmt->execute()){
            $error_array = array('Error(s):');
            array_push($error_array, $conn->error);
            $_SESSION['error'] = $error_array;
        }
        header('Location: http://34.135.39.226/team/manageTypesTable.php', true, 303);
        die();
    }


    // Delete all checked items
    if (del_sel_checkbox("types", $sql_path . "/DML/DeleteTypes.sql")) {
        header('Location: http://34.135.39.226/team/manageTypesTable.php', true, 303);
        die();
    }

    ?>
        <link rel="stylesheet" href="basic.css">

    <h1>Manage Types</h1>
    <h3>Add a new Type</h3>
        <p>

            <form method=POST>
                <input type=text name=typeName placeholder='Enter type name...' required/>
                <input type=submit value='Add New Move'/>
            </form>
        </p>

        <h3>Update an existing Type Name</h3>
            <form method="POST">
                <?php drop_down_options('/DML/ViewTypes.sql', 1, $sql_path, 'Choose a Type', 'typeID'); ?>
                <input type=text name=newTypeName placeholder='Enter new type name...' required/>
                <input type=submit value='Update Type Name'/>
            </form>
</body>
<?php

// Establish query for getting all current types. (I use the view here because it gives data that is useful to the person looking, not just a bunch of numbers)
$sql_query =  file_get_contents($sql_path . "/DML/ViewTypes.sql");
// The rest of this should just be copy and pasted
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
res_to_table($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>