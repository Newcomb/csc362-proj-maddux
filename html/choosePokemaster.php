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
    //Create menu
    include "menu.php";
    include "viewTable.php";
    include "drop_down_options.php";
    ?>
    <h1>Welcome to Bill's Move Tutoring Site!</h1>
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



// Insert an owned pokemon
if (isset($_POST['pokemasterID'])) {
    $link = 'Location: http://34.135.39.226/team/chooseOwnedPokemon.php?pokeID=' . $_POST['pokemasterID'];
    echo $link;
    header($link,true);
    die();
}


?>
            <form method=POST>
                <?php drop_down_options('/DML/ViewPokemasters.sql', 0, $sql_path, 'Choose a Pokemaster', 'pokemasterID'); ?>
                <input type=submit value='Choose Pokemaster'/>
            </form>

</body>
<?php
// Query in order to get the table result
$sql_query = file_get_contents($sql_path . "/DML/ViewPokemasters.sql");

$result = $conn->query($sql_query);

// Run function to establish the table
viewTable($result, $_SERVER['REQUEST_URI']);

// Close the connection
$conn->close();

?>
</html>