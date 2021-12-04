<?php
function viewTable($res,$path) {
    // Get array of table vals set up
    $num_rows = $res->num_rows;
    $num_cols = $res->field_count;
    $resar = $res->fetch_all();
    ?>
    <form action=<?php echo $path ?> method=POST>
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
    </tr>
    <?php
    }
?>
    </tbody>
    </table>
    </form>
    <!-- <form action=<?php// echo $path ?> method=POST>
        <input type="submit" name="toggle" value="Toggle Light/Dark Mode"/>
    </form>  -->
<?php
}
?>