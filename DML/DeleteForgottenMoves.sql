-- Deletion statement for forgotten moves.
DELETE FROM forgotten_moves WHERE (owned_pokemon_id = ? AND move_id = ?);
