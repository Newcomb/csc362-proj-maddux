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
SELECT owned_pokemon_id, move_id, type_id AS knownMoveType
    FROM known_moves INNER JOIN owned_pokemon
        USING owned_pokemon_id
    FROM owned_pokemon INNER JOIN pokedex
        USING pokemon_id
    FROM pokedex INNER JOIN pokemon_types
        USING pokemon_id;

/*Trigger to make sure pokemon types match move types (all can learn normal except ghosts)*/
CREATE TRIGGER checkMoveType 
BEFORE
INSERT | UPDATE
ON knownMoveType  
FOR EACH ROW 
[trigger_body] 
/*Implement logic that matches type_id with move_type; if ghost: only ghost can match*/