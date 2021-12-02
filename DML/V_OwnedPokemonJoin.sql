DROP VIEW IF EXISTS owned_pokemon_join;
--Number of routes at each difficulty at every crag
CREATE VIEW owned_pokemon_join AS
SELECT owned_pokemon_id, pokemaster_id, pokemaster_first_name, pokemaster_last_name, pokemon_id, pokemon_name
FROM owned_pokemon
INNER JOIN pokemasters USING (pokemaster_id)
INNER JOIN pokedex USING (pokemon_id)
ORDER BY (owned_pokemon_id);