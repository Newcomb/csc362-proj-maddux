-- This trigger will removes a pokemons forgotten move if it just relearned it
DROP TRIGGER IF EXISTS remove_forgotten_move_if_taught_update;
DELIMITER //
CREATE TRIGGER remove_forgotten_move_if_taught_update
    AFTER UPDATE ON known_moves
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(owned_pokemon_id) FROM forgotten_moves WHERE (owned_pokemon_id = NEW.owned_pokemon_id AND move_id = NEW.move_id)) = 1 THEN 
        DELETE FROM forgotten_moves WHERE (owned_pokemon_id = NEW.owned_pokemon_id AND move_id = NEW.move_id);
    END IF;
 END; //
DELIMITER ;