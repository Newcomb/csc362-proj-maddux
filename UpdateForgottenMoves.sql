--Update sql for forgotten moves
UPDATE forgotten_moves
SET move_id = ?
WHERE owned_pokemon_id = ?;