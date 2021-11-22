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
    include 'menu.php';
    include "viewTable.php";    
?>
</head>
<body>
    <h1>View Types Table</h1>
    
</body>
<?php
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

//Open mysqli connection and check for errors
if (!$conn = new mysqli($host, $user, $pass, $dbse)){
    echo "Error: Failed to make a MySQL connection: " . "<br>";
    echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";
    exit;
}

// Establish query for getting all current instruments
$sql_query = "SELECT * FROM types";
// Query the database using the select statement
$result = $conn->query($sql_query);
//Print result on page
viewTable($result, $_SERVER['REQUEST_URI']);
$conn->close();
?>    
</html>