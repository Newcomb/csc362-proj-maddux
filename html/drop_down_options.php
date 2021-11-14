<?php
// Takes tablename, filename, index of item in database, path for sql, the label name, and the post name
function drop_down_options($fileName, $index, $sql_path, $label, $postname) {
    // establish conn as the global conn
    $conn = $GLOBALS['conn'];
    ?>
    <label for=<?= $label ?>> <?= $label ?></label>
    <select name=<?= $postname ?>>
    <?php
     // Establish query for getting all current instruments
     $sql_query = file_get_contents($sql_path . $fileName);
     // Query the database using the select statement
     $result = $conn->query($sql_query);
     $num_rows = $result->num_rows;
     $resar = $result->fetch_all();

    for ( $i = 0; $i < $num_rows; $i++ ) {
        // Prints the value of a table
        ?>
            <option value=<?php echo $resar[$i][0];?>><?php echo $resar[$i][$index]; ?></option>
        <?php
        }
        ?>

    </select>
    <?php
    }
?>