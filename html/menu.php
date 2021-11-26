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
        <h1>Bill's Move Tutor Site</h1>
        <!-- The navigation menu -->
        <div class="navbar">
            <a href="home.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Services <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="hiddenDeletion.php">Hidden Move Deletion</a>
                    <a href="managePokemonTable.php">Manage All Pokemon</a>
                    <a href="manageOwnedPokemonTable.php">Manage Owned Pokemon</a>

                    <div class="dropdown">
                            <button class="dropbtn" id="viewdb">View Database Pages
                            <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="viewPokedexTable.php">Pokedex Table</a>
                                <a href="viewPokemasterTable.php">Pokemaster Table</a>
                                <a href="viewPokemasterRatingsTable.php">Pokemaster Ratings Table</a>
                                <a href="viewMovesTable.php">Moves Table</a>
                                <a href="viewTypesTable.php">Types Table</a>
                                <a href="viewPokemonTypesTable.php">PokemonTypes Table</a>
                                <a href="viewKnownMovesTable.php">KnownMoves Table</a>
                                <a href="viewForgottenMoves.php">ForgottenMoves Table</a>
                                <a href="viewRatingCounts.php">RatingCounts Table</a>
                            </div>
                        </div> 

                    <div class="dropdown">
                        <button class="dropbtn" id="managedb">Manage Database Pages
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="pokedexTable.php">Pokedex Table</a>
                            <a href="pokemasterTable.php">Pokemaster Table</a>
                            <a href="pokemasterRatingsTable.php">Pokemaster Ratings Table</a>
                            <a href="movesTable.php">Moves Table</a>
                            <a href="typesTable.php">Types Table</a>
                            <a href="pokemonTypesTable.php">PokemonTypes Table</a>
                            <a href="knownMovesTable.php">KnownMoves Table</a>
                            <a href="forgottenMovesTable.php">ForgottenMoves Table</a>
                            <a href="ratingCountsTable.php">RatingCounts Table</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subnav">
                <button class="subnavbtn">Schedule <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="viewSchedule.php">View Schedule</a>
                    <a href="manageSchedule.php">Manage Schedule</a>
                </div>
            </div>
                <a href="rateMyServices.php">Rate Bill's Services</a>
                <a href="about.php">About</a>
        </div>
    <?php
    }
    //actually call function
    create_menu();
    ?>
</body>
</html>