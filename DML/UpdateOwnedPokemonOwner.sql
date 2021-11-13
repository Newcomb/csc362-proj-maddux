-- Allows for the transference of an owned pokemon to another pokemaster in the system.
UPDATE owned_pokemon SET pokemaster_id = (?) WHERE (owned_pokemon_id = ?);
