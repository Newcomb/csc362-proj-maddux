-- Updates pokemasters first name
UPDATE pokemasters 
SET pokemaster_first_name = ?
WHERE (pokemaster_id = ?);
