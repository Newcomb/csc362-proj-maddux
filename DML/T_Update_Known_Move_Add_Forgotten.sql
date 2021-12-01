-- This trigger will adds a move that is updated to forgotten moves
DROP TRIGGER IF EXISTS update_known_move_add_forgotten;
DELIMITER //
CREATE TRIGGER update_known_move_add_forgotten
    AFTER UPDATE ON known_moves
    FOR EACH ROW
BEGIN 
    IF (SELECT COUNT(move_id) FROM forgotten_moves WHERE (move_id = OLD.move_id AND owned_pokemon_id = OLD.owned_pokemon_id)) = 0 THEN
    BEGIN
    INSERT INTO forgotten_moves (owned_pokemon_id, move_id)
    VALUES  (OLD.owned_pokemon_id, OLD.move_id);
    END;
    END IF;
 END; //
DELIMITER ;