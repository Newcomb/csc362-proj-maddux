-- Updates pokemasters last name
UPDATE pokemasters 
SET pokemaster_last_name = ?
WHERE (pokemaster_id = ?);
