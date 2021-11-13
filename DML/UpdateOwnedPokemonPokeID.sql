-- Allows for the changing of pokemon_id
UPDATE owned_pokemon SET pokemon_id = (?) WHERE (owned_pokemon_id = ?);