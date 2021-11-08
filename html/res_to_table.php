<?php
function res_to_table($res) {
    // Get array of table vals set up
    $num_rows = $res->num_rows;
    $num_cols = $res->field_count;
    $resar = $res->fetch_all();
    ?>
    <p>
    <?php echo $num_cols; ?> columns, <?php echo $num_rows; ?> rows.
    </p>
    <form action="deleteFromTable.php" method=POST>
        <table>
        <thead>
        <tr>
    <?php
    // loop that writes the table headers
    while ($fld = $res->fetch_field()) {
    ?>
        <th><?php echo $fld->name; ?></th>
    <?php
    }
    ?>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Loop for the rows of the table
    for ($i=0;$i<$num_rows; $i++) {
    ?>
    <tr>
    <?php
    // Loop for the columns of the table
        for ( $j = 0; $j < $num_cols; $j++ ) {
            // Prints the value of a table
    ?>
            <td><?php echo $resar[$i][$j]; ?></td>
    <?php
        }
    ?>
    <td>
    <input type="checkbox" 
            name="checkbox<?php echo $resar[$i][0] ?>"
             value=<?php echo $resar[$i][0] ?>
            />  
    </td>
        </tr>
    <?php
    }
?>
    </tbody>
    </table>
    <p><input type="checkbox"  name="deleteAll"/>Delete all records</p>
    <input type="submit" value="Delete Selected Records"/><br><br>
    </form>
    <form action="deleteFromTable.php" method=POST>
        <input type="submit" name="toggle" value="Toggle Light/Dark Mode"/>
    </form> 
<?php
}
?>