--Update sql for known moves
UPDATE known_moves
SET move_id = ?
WHERE owned_pokemon_id = ?;