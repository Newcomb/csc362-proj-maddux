<?php
function del_sel_checkbox($table, $fileName) {
    $host = "localhost";
    $user = "newcomb";
    $pass = "YoloSwag13";
    $dbse = "pokemon_db";

    //Open mysqli connection and check for errors
    if (!$conn = new mysqli($host, $user, $pass, $dbse)){
        echo "Error: Failed to make a MySQL connection: " . "<br>";
        echo "Errno: $conn->connect_errno; i.e. $conn->connect_error \n";
        exit;
    }
// Establish query for getting all current pokemon
    $sql_query = "SELECT * FROM " . $table;

    // Query the database using the select statement
    $result = $conn->query($sql_query);

    //Get all records that could be deleted into array format
    $records = $result->fetch_all();
    $record_rows = $result->num_rows;

    // Prepare the delete statement
    $stmt = $conn->prepare(file_get_contents($fileName));
    $stmt->bind_param('i', $id);
    $flag = FALSE;
    // Loop through all the records in the table and check if their checkbox was clicked for deletion
    for($i = 0; $i < $record_rows; $i++) {
        $id = $records[$i][0];
        // Delete the records
        if(isset($_POST["checkbox" . $id]) && !$stmt->execute()) {
            // Bind and execute the prepared statement
            echo $conn->error();
        }
        if(isset($_POST['checkbox' . $id])){
            $_SESSION['counter'] = $_SESSION['counter'] + 1;
            $flag = TRUE;
        }
    }
    $conn->close();
    if ($flag) {
        header('Location: http://34.135.39.226/pokemonTable.php', true, 303);
        die();
    }
}
?>