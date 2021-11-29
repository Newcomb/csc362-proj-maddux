-- Create function that returns the type of an ownedPokemon
DROP FUNCTION IF EXISTS getOwnedPokemonType;
CREATE FUNCTION getOwnedPokemonType (ownedPokeID INT) 
RETURNS INT
RETURN (SELECT type_id FROM owned_pokemon INNER JOIN pokemon_types USING (pokemon_id) WHERE (owned_pokemon_id = ownedPokeID));