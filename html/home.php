<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="menu.css">
    
    <!--Pokemon Font Link-->
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet"> 
    
</head>
<body>
    <?php
    //Create menu
    include "menu.php";
    include "viewTable.php";
    ?>
    <h1>Welcome to Bill's Move Tutoring Site!</h1>
    <img src="pokeball.png" alt="Pokeball" style="float:center;width:33%;height:33%;">
    <!-- Source above claimed to be open source -->
    <!-- END of main HTML -->
    <h3>Scheduled Moves</h3>

<?php
//Instantiate mysqli data
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

$reload = false;

//header
if($reload){ 
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit();
} 

// Query in order to get the table result
$sql_query = "SELECT * FROM schedule_join";

$result = $conn->query($sql_query);

// Run function to establish the table
viewTable($result, $_SERVER['REQUEST_URI']);



?>
<h3>Popular Moves</h3>
<?php
// Query in order to get the table result
$sql_query = "SELECT * FROM Count_Rating";

$res = $conn->query($sql_query);

// Run function to establish the table
viewTable($res, $_SERVER['REQUEST_URI']);
// Close the connection
$conn->close();

?>

</html>

<?php

?>
</body>
</html>