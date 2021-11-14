<!DOCTYPE html>
<html>
<head>
    <?php
    //Check if the cookie is set and if not establish the cookie
    if(!isset($_COOKIE['darkmode'])){
        setcookie('darkmode', false, time());
    }

    //Set style based on cookie
    if ($_COOKIE['darkmode']){
    ?>
        <link rel="stylesheet" href="darkmode.css">
    <?php
    } 
    else {
    ?>
        <link rel="stylesheet" href="menu.css">
    <?php
    }
    ?>
    <!--Pokemon Font Link-->
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet"> 
    
</head>
<body>
    <h1>Welcome to Bill's Move Tutor Site</h1>
    
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="menu.css">
    <!-- The navigation menu -->
    <div class="navbar">
    <a href="#home">Home</a>
    <div class="subnav">
        <button class="subnavbtn">Services <i class="fa fa-caret-down"></i></button>
        <div class="subnav-content">
        <a href="#train">Train</a>
        <a href="#move-deletion">Move Deletion</a>
        <a href="pokemasterTable.php">View Database</a>
        <a href="pokemonTable.php">Edit Database</a>
        </div>
    </div>
    <div class="subnav">
        <button class="subnavbtn">Schedule <i class="fa fa-caret-down"></i></button>
        <div class="subnav-content">
        <a href="#move-schedule">Move Schedule</a>
        </div>
    </div>
    <a href="#contact">Rate My Services</a>
    <a href="about.php">About</a>
    </div>
    <?php
    
    ?>
    <!-- END of main HTML -->
    <?php
    //Start a session if user logged in
    session_start();
    //Set session variables
    if(isset($_POST['username']) && !isset($_SESSION['user'])){
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['num_checked'] = 0;
        $_SESSION['start_time'] = time();

        $reload = true;
    }

    //check if time limit has expired or if the user has logged out
    if((isset($_SESSION['start_time']) && (time() - $_SESSION['start_time'] > 1800)) || (isset($_POST['logout']))){

        session_unset();
        session_destroy();
        $reload = true;
    }

    //Check if session is set by user to decide whether or not to have login text box
    if (!isset($_SESSION['user'])){
    ?>

    <h3>Remember my session:
        <form method=POST>
            <input type=text name=username placeholder='Enter name...'/>
            <input type=submit value='Remember Me'/>
        </form>
    </h3>

    <form action="menu.php" method=POST>
        <input type="submit" name="togglemode" value="Toggle Light/Dark Mode"/>
    </form>

    <?php
    } 
    else {
        //If set welcome the user
        echo "<p> Welcome " . $_SESSION['user'] . "!</p>";
        //Create new dropdown option to view user's pokemon
    ?>
        
    </div>

    <form method=POST>
        <input type=submit name='logout' value='Log Out'/>
    </form>
    <?php
    }
    ?>
</body>

<?php
//Instantiate mysqli data
$host = "localhost"; //CHANGE ME
$user = "joshw";
$pass = "lion362";
$dbase = "pokemon_db";

//Open mysqli connection and check for errors
if (!$conn = new mysqli($host, $user, $pass, $dbase)){

    echo "Error: Failed to make a MySQL connection: " . "<br>";

    echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";

    exit;
}

// Establish query for getting all current instruments
$sql_query = "SELECT * FROM instruments";
 
// Query the database using the select statement
$result = $conn->query($sql_query);

//Get all records that could be deleted into array format
$records = $result->fetch_all();

$record_rows = $result->num_rows;

// Prepare the delete statement
$stmt = $conn->prepare("DELETE FROM instruments WHERE instrument_id = ?");
$stmt->bind_param('i', $id);

$reload = false;

// Loop through all the records in the table and check if their checkbox was clicked for deletion
for($i = 0; $i < $record_rows; $i++) {

    $id = $records[$i][0];

    //check if id is set to increment the num_checked
    if(isset($_POST['checkbox' . $id])){

       $_SESSION['num_checked'] = $_SESSION['num_checked'] + 1;

        $reload = true;
    }

    //Check if delete all is set and increment the num_checked
    if(isset($_POST['deleteAll'])){

        $_SESSION['num_checked'] = $_SESSION['num_checked'] + 1;
    }

    // Delete the records
    if(isset($_POST["checkbox" . $id]) && !$stmt->execute()) {

        // Bind and execute the prepared statement
        echo $conn->error();
    }
}
 
// If the checkbox for adding more values is checked then add values
if(isset($_POST["reset"])) {

    $conn->query("INSERT INTO instruments (instrument_type)

                        VALUES  ('Guitar'),

                                ('Trumpet'),

                                ('Flute'),

                                ('Theramin'),

                                ('Violin'),

                                ('Tuba'),

                                ('Melodica'),

                                ('Trombone'),

                                ('Keyboard')

                 ");

    // Header to prevent re adding values with the refresh of page after the

    // initial post.

    $reload = true;

}

// If the checkbox for deleting all the records is clicked then delte all records
if(isset($_POST["deleteAll"])) {

    $conn->query("DELETE FROM instruments");

    $reload = true;

}

// Check if cookie has been toggled and reset the page
if(isset($_POST['togglemode'])){

    if($_COOKIE['darkmode'] == FALSE){
        setcookie('darkmode', TRUE);
    } 
    else {
        setcookie('darkmode', FALSE);
    }

    $reload = true;

}

//header
if($reload){ 
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit();
} 

// Query in order to get the table result
$stmt = $conn->prepare($sql_query);

$stmt->bind_param();

$stmt->execute();

$result = $stmt->get_result();

 

// Run function to establish the table
res_to_table($result);

// Close the connection
$conn->close();

?>

</html>

<?php

?>
</body>
</html>