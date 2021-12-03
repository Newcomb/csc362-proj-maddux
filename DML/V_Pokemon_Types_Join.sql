-- View that shows the pokemon name and its linked type name
DROP VIEW IF EXISTS pokemon_types_join;
CREATE VIEW pokemon_types_join AS
SELECT pokemon_type_id AS 'Pokemon ID', pokemon_name AS 'Pokemon Name', 
type_name AS 'Type'
FROM pokemon_types 
INNER JOIN pokedex
USING (pokemon_id)
INNER JOIN types
USING (type_id)
ORDER BY (pokemon_id);