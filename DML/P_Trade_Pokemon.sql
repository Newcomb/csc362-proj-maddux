-- Create procedure to trade the pokemon
DROP FUNCTION IF EXISTS trade;
DELIMITER //
CREATE FUNCTION trade (PokeOne INT, PokeTwo INT)
RETURNS INT
BEGIN
        DECLARE PokeTwoTrainerHold INT;
        SET PokeTwoTrainerHold = (SELECT getTrainerID(PokeTwo));
        -- Start the transaction
        UPDATE owned_pokemon
        SET pokemaster_id_id = (getTrainerID(PokeOne))
        WHERE (owned_pokemon_id = PokeTwo);

        UPDATE owned_pokemon
        SET pokemaster_id = (SELECT PokeTwoTrainerHold)
        WHERE (owned_pokemon_id = (PokeOne));
        RETURN 1;
END; //
DELIMITER ;