/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a view that shows all Pokemasters and their ratings for moves they have rated.

  Created 11-01-21
*/

USE pokemon_db;

/*Select all Pokemasters and their ratings*/
SELECT PokemasterID, MoveID, StarRating AS AllPokemasterRatings
    FROM PokemasterRatings;