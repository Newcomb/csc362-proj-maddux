-- Deletion statement for forgotten moves.
DELETE FROM forgotten_moves WHERE (forgotten_move_id = ?);
