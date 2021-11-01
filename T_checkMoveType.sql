/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a trigger that is activated on insert or update of a KnownMove that checks that the pokemon types
  match the move types. A view is also created to be used in the trigger more cleanly.

  Created 11-01-21
*/

/*Create view showing KnownMoves of a OwnedPokemon and the Type of those moves*/
/*Need to go from KnownMoves->OwnedPokemon->Pokedex->PokemonTypes. How do I do that with joins?*/
SELECT OwnedPokemonID, MoveID, TypeID AS KnownMoveType
    FROM KnownMoves INNER JOIN OwnedPokemon
        USING OwnedPokemonID
    FROM OwnedPokemon INNER JOIN Pokedex
        USING PokemonID
    FROM Pokedex INNER JOIN PokemonTypes
        USING PokemonID;

/*Trigger to make sure pokemon types match move types (all can learn normal except ghosts)*/
CREATE TRIGGER checkMoveType 
BEFORE
INSERT | UPDATE
ON KnownMoveType  
FOR EACH ROW 
[trigger_body]