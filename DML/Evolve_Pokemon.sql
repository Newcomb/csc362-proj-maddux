-- Decided against this because we are tired :(
UPDATE owned_pokemon
SET pokemon_id = (SELECT pokemon_id FROM pokemon WHERE (pokemon_name = ?))
WHERE (owned_pokemon_id = ?);