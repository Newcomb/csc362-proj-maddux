-- Allow for move deletion from known moves populating with php.
DELETE FROM known_moves WHERE (owned_pokemon_id = ? AND move_id = ?);
