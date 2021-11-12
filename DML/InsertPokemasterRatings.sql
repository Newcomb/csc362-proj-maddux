-- Prepared SQL for pokemaster rating injection 
-- question marks will be filled in using php.
INSERT INTO pokemaster_ratings (pokemaster_id, move_id, star_rating)
VALUES (?, ?, ?);
