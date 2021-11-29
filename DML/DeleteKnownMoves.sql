-- Allow for move deletion from known moves populating with php.
DELETE FROM known_moves WHERE (known_move_id = ?);
