-- View that shows the pokemon name and its linked type name
DROP VIEW IF EXISTS pokemon_types_join;
CREATE VIEW pokemon_types_join AS
SELECT pokemon_type_id, pokemon_name, type_name
FROM pokemon_types 
INNER JOIN pokedex
USING (pokemon_id)
INNER JOIN types
USING (type_id);