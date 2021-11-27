DROP VIEW IF EXISTS forgotten_moves_join;
CREATE VIEW forgotten_moves_join AS 
SELECT owned_pokemon_id, pokemon_name, move_id, move_name
FROM forgotten_moves
INNER JOIN moves USING (move_id)
INNER JOIN types USING (type_id)
INNER JOIN owned_pokemon USING (owned_pokemon_id)
INNER JOIN pokedex USING (pokemon_id);