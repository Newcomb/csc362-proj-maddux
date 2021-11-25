-- Update sql for known moves
UPDATE known_moves
SET move_id = ?
WHERE (owned_pokemon_id = ? AND move_id = ?);