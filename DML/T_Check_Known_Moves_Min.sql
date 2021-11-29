-- This trigger will prevent known moves from being deleted when there is only one left for a specific pokemon
DROP TRIGGER IF EXISTS check_known_moves_min;
DELIMITER //
CREATE TRIGGER check_known_moves_min
    BEFORE DELETE ON known_moves
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(owned_pokemon_id) FROM known_moves WHERE (owned_pokemon_id = OLD.owned_pokemon_id)) = 1 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot Delete: This pokemon has the minimum amount of known moves.';
    END IF;
 END; //
DELIMITER ;