-- View that shows the pokedex without field names
DROP VIEW IF EXISTS pokedex_view;
CREATE VIEW pokedex_view AS
SELECT pokemon_id AS 'Pokemon ID', pokemon_name AS 'Pokemon Name'
FROM pokedex
ORDER BY (pokemon_id);