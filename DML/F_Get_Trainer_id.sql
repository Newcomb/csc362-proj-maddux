-- Create function to get trainerID when trading
DROP FUNCTION IF EXISTS getTrainerID;
CREATE FUNCTION getTrainerID (PokeID INT) 
RETURNS INT 
RETURN (SELECT pokemaster_id FROM pokemasters INNER JOIN owned_pokemon USING (pokemaster_id) WHERE (owned_pokemon_id = pokeID));