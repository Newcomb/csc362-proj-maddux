<?php
ini_set ("display_errors",1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<?php 
    include 'menu.php';
    include "viewTable.php";
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

$host = "localhost";
$user = "webuser";
$pass = "mewtwo";
$dbse = "pokemon_db";
$sql_path = "/home/anazj/csc362-proj-maddux/html/manageRatingCountsTable.php";

//Open mysqli connection and check for errors
if (!$conn = new mysqli($host, $user, $pass, $dbse)){
    echo "Error: Failed to make a MySQL connection: " . "<br>";
    echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";
    exit;
}



// Insert a ratings count 
if (isset($_POST['Insert'])) {
    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertRatingCounts.sql"));
    $stmt->bind_param('i',$_POST['RatingCount']);
    $stmt->execute();
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    die();
}

// Establish query for getting all current instruments
$sql_query = "SELECT * FROM rating_counts";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
viewTable($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>

</head>    

<body>
    <h1>Manage Ratings Counts</h1>
    <h3>Add a new Rating Count</h3>
    <form method="POST" action='manageRatingCountsTable.php'>
            <input type="text" name="New Rating" placeholder="Enter New Rating">
            <input type="submit" value="InsertRatingCount" name="Insert">
            <br><br>
          
           
        </form>


</body>

</html>