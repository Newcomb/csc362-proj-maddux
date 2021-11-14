/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the main script to source all sql tables*/
DROP DATABASE IF EXISTS pokemon_db;
CREATE DATABASE pokemon_db;

USE pokemon_db;

-- Source all sql files
SOURCE Tables/Pokemasters.sql;
SOURCE Tables/Types.sql;
SOURCE Tables/Moves.sql;
SOURCE Tables/Pokedex.sql;
SOURCE Tables/OwnedPokemon.sql;
SOURCE Tables/Schedule.sql;
SOURCE Tables/PokemonTypes.sql;
SOURCE Tables/KnownMoves.sql;
SOURCE Tables/ForgottenMoves.sql;
SOURCE Tables/RatingCounts.sql; 
SOURCE Tables/PokemasterRatings.sql;

-- Add values to the table
SOURCE Tables/TableValues.sql;

-- Generate views
SOURCE DML/ViewForgottenMoves.sql;
SOURCE DML/ViewKnownMoves.sql;
SOURCE DML/ViewOwnedPokemon.sql;
SOURCE DML/ViewPokedex.sql;
SOURCE DML/ViewPokemasterRatings.sql;
SOURCE DML/ViewPokemasters.sql;
SOURCE DML/ViewRatingCounts.sql;
SOURCE DML/ViewTypes.sql;
SOURCE DML/V_OwnedPokemonJoin.sql;