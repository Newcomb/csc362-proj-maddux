-- Deletion sql for pokemaster ratings records
DELETE FROM pokemaster_ratings WHERE (move_id = ? AND pokemaster_id = ?);
