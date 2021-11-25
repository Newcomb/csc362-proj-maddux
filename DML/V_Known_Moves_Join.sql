DROP VIEW IF EXISTS known_moves_join;
--Number of routes at each difficulty at every crag
CREATE VIEW known_moves_join AS
SELECT owned_pokemon_id, pokemon_name, move_id, move_name, hidden_move
FROM known_moves
INNER JOIN moves USING (move_id)
INNER JOIN types USING (type_id)
INNER JOIN owned_pokemon USING (owned_pokemon_id)
INNER JOIN pokedex USING (pokemon_id);