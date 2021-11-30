-- This trigger will prevent ghost types from learning normal moves
DROP TRIGGER IF EXISTS check_type_match_or_normal_update;
DELIMITER //
CREATE TRIGGER check_type_match_or_normal_update
    BEFORE UPDATE ON known_moves
    FOR EACH ROW
BEGIN
    IF (getOwnedPokemonType(NEW.owned_pokemon_id) != getMoveType(NEW.move_id) AND (getMoveType(NEW.move_id) != 1 )) THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot Update: Types and moves must match unless the move is normal.';
    END IF;
 END; //
DELIMITER ;