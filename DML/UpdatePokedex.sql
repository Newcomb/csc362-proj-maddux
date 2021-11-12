-- Update sql for pokedex
UPDATE pokedex
SET pokemon_name = ?
WHERE pokemon_id = ?;