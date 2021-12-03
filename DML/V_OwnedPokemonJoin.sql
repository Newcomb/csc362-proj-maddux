DROP VIEW IF EXISTS owned_pokemon_join;
--Number of routes at each difficulty at every crag
CREATE VIEW owned_pokemon_join AS
SELECT owned_pokemon_id AS 'Ownned Pokemon ID', pokemaster_id AS 'Pokemaster ID', pokemaster_first_name AS 'Pokemaster First Name', pokemaster_last_name AS 'Pokemaster Last Name', pokemon_name AS 'Pokemon Name'
FROM owned_pokemon
INNER JOIN pokemasters USING (pokemaster_id)
INNER JOIN pokedex USING (pokemon_id)
ORDER BY (owned_pokemon_id);