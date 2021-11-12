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
SOURCE Pokemasters.sql;
SOURCE Types.sql;
SOURCE Moves.sql;
SOURCE Pokedex.sql;
SOURCE OwnedPokemon.sql;
SOURCE Schedule.sql;
SOURCE PokemonTypes.sql;
SOURCE KnownMoves.sql;
SOURCE ForgottenMoves.sql;
SOURCE RatingCounts.sql; 
SOURCE PokemasterRatings.sql;

-- Generate views
SOURCE ViewForgottenMoves.sql;
SOURCE ViewKnownMoves.sql;
SOURCE ViewOwnedPokemon.sql;
SOURCE ViewPokedex.sql;
SOURCE ViewPokemasterRatings.sql;
SOURCE ViewPokemasters.sql;
SOURCE ViewRatingCounts.sql;
SOURCE ViewTypes.sql;