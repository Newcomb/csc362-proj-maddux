--Delete a pokemons type link
DELETE FROM pokemon_types WHERE (type_id = ? AND pokemon_id = ?);
