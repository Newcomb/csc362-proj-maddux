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
   
// Insert a ratings count 
if (isset($_POST['Insert'])) {
    
    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($sql_path . "/DML/InsertRatingCounts.sql") );
    // access another sql path to be able to insert 
    $stmt->bind_param('ii', $_POST['moveID'], settype($_POST['New Rating'], 'int') );
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

?>

</head>    

<body>
    <h1>Manage Ratings Counts</h1>
    <h3>Add a new Rating Count</h3>
    <form method="POST" action='manageRatingCountsTable.php'>
            <input type="text" name="New Rating" placeholder="Enter New Rating">
            <input type="submit" value="InsertRatingCount" name="Insert"> <br><br>
            <?php drop_down_options('/DML/ViewMoves.sql', 1, $sql_path, 'Choose a moveID', 'moveID'); ?>
            

        </form>
   

</body>

</html>

<?php 

//  $sql = "SELECT move_id FROM moves;";
//  $result2 = $conn->query($sql);
//  viewTable($result2, $_SERVER['REQUEST_URI']);


 
//  $sql3="SELECT COUNT(*) FROM ratings_counts;";
//  $result3 = $conn->query($sql3);
 

//  for ($x = 0; $x < $result3; $x++) {
//     $sql2="SELECT COUNT(move_id) FROM rating_counts WHERE move_id= $x;";
//      $result4 = $conn->query($sql2);
//     printf("The count is: %d <br>" , $x );
//   }

// foreach($result2 as $dbrow) 
// { 
//         echo " " . "<br>";
//         echo implode($dbrow) ;
     

// }

$conn->close();
?>