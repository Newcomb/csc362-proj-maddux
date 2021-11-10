<h1> Pokemasters </h1>

<?php

    include "res_to_table.php";
   
   // first we will check if the cookie has not been created 
    if(!isset($_COOKIE['dark_mode']))
    {
        setcookie('dark_mode', FALSE, time() + (20 * 365 * 24 * 60 * 60));
        
    }

    /*if the cookie has been created then we can set the dark style
    if has not then set the basic style*/

     if(isset($_COOKIE['dark_mode']))
    {
?>
         <link rel="stylesheet" href="darkmode.css">
   
  <?php  
    }

     else
     {
?>
          <link rel="stylesheet" href="basic.css">
<?php
     }
?>

<?php
        /*checking if the cookie has been toggled then check darkmode is true or false
        */
        if(isset($_POST['togglemode'])){
        
            if($_COOKIE['dark_mode']==FALSE)
        
            {
                setcookie('dark_mode', TRUE);
        
            }

        
            else
        
            {
                setcookie('dark_mode', FALSE);

            }

            header('Location: http://34.135.39.226/deleteFromTable.php', true, 303);
            exit();
    
    }

$host = "localhost";
$user = "newcomb";
$pass = "YoloSwag13";
$dbse = "pokemon_db";

//Opens connection and check for errors
if (!$conn = new mysqli($host, $user, $pass, $dbse)){
    echo "Error: Failed to make a MySQL connection: " . "<br>";
    echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";
    exit;
}

// Establish query for getting all records in the table 
$sql_query = "SELECT pokemonmaster_id, pokemaster_first_name, pokemaster_last_name FROM pokemasters";
// Query the database with query statement
$result = $conn->query($sql_query);
//call function which will print the table
res_to_table($result);


?>
