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

--Source all sql files
SOURCE PokeMaster.sql;
SOURCE Moves.sql;
SOURCE Pokedex.sql;
SOURCE Types.sql;
SOURCE OwnedPokemon.sql;
SOURCE Schedules.sql;
SOURCE PokemonTypes.sql;
SOURCE KnownMoves.sql;
SOURCE ForgottenMoves.sql;
SOURCE RatingCounts.sql; 
SOURCE PokemasterRatings.sql;
SOURCE AllPokemasterRatings.sql;
SOURCE DeleteForgottenMoves.sql;
SOURCE DeleteKnownMoves.sql;
SOURCE DeleteOwnedPokemon.sql;
SOURCE DeletePokedex.sql;
SOURCE InsertForgottenMoves.sql;
SOURCE InsertKnownMoves.sql;
SOURCE InsertMoveDefaultStatus.sql;
SOURCE InsertMoveStatusGiven.sql;
SOURCE InsertPokemasters.sql;
SOURCE InsertPokemon.sql;
SOURCE InsertPokemonTypes.sql;
SOURCE InsertTypes.sql;
SOURCE T_checkMoveType.sql;
SOURCE UpdateOwnedPokemonOwner.sql;
SOURCE ViewForgottenMoves.sql;
SOURCE ViewKnownMoves.sql;
SOURCE ViewOwnedPokemon.sql;
SOURCE ViewPokedex.sql;
SOURCE ViewPokemasterRatings.sql;
SOURCE ViewPokemasters.sql;
SOURCE ViewRatingCounts.sql;
SOURCE ViewTypes.sql;