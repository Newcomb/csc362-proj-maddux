DROP VIEW IF EXISTS known_moves_join;
--Number of routes at each difficulty at every crag
CREATE VIEW known_moves_join AS
SELECT known_move_id AS 'Known Move ID', owned_pokemon_id AS 'Owned Pokemon ID', pokemon_name AS 'Pokemon Name', move_id, move_name AS 'Move Name', hidden_move AS 'Hidden Move'
FROM known_moves
INNER JOIN moves USING (move_id)
INNER JOIN types USING (type_id)
INNER JOIN owned_pokemon USING (owned_pokemon_id)
INNER JOIN pokedex USING (pokemon_id)
ORDER BY (owned_pokemon_id);;