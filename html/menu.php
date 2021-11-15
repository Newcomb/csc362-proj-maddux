<!DOCTYPE html>
<html>
<head>
    <!--Pokemon Font Link-->
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">    
</head>
<body>
    <?php 
    //Make menu function; Might need to have everything except menu in index.php or home.php
    function create_menu()
    {
    ?>
        <!-- Load font awesome icons -->
        <link rel="stylesheet" href="menu.css">
        <!-- The navigation menu -->
        <div class="navbar">
        <a href="home.php">Home</a>
        <div class="subnav">
            <button class="subnavbtn">Services <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
            <a href="#train">Train</a>
            <a href="#move-deletion">Move Deletion</a>
            <a href="pokemasterTable.php">View Database</a>
            <a href="managePokemonTable.php">Manage All Pokemon</a>
            <a href="manageOwnedPokemonTable.php">Manage Owned Pokemon</a>
            </div>
        </div>
        <div class="subnav">
            <button class="subnavbtn">Schedule <i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
            <a href="#move-schedule">Move Schedule</a>
            </div>
        </div>
        <a href="#rate-services">Rate My Services</a>
        <a href="about.php">About</a>
        </div>
    <?php
    }
    //actually call function
    create_menu();
    ?>
</body>
</html>