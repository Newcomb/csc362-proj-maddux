<?php
function del_sel_checkbox_cpk($table, $fileName, $firstPart, $secondPart) {
    // establish conn as the global conn
    $conn = $GLOBALS['conn'];
// Establish query for getting all current pokemon
    $sql_query = "SELECT * FROM " . $table;

    // Query the database using the select statement
    $result = $conn->query($sql_query);

    //Get all records that could be deleted into array format
    $records = $result->fetch_all();
    $record_rows = $result->num_rows;

    // Prepare the delete statement
    // THIS DOESNT WORK AS IT IS SUPPOSED TOO!!!!
    $stmt = $conn->prepare(file_get_contents($fileName));
    $stmt->bind_param('ii', $idOne, $idTwo);
    // Loop through all the records in the table and check if their checkbox was clicked for deletion
    for($i = 0; $i < $record_rows; $i++) {
        $idOne = $records[$i][$firstPart];
        $idTwo = $records[$i][$secondPart];
        // Delete the records
        if(isset($_POST["checkbox" . $idOne]) && !$stmt->execute()) {
            // Bind and execute the prepared statement
            echo $conn->error();
        }
    }
}
?>