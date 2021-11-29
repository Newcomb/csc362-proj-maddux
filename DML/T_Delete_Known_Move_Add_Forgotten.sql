-- This trigger will adds a move that is deleted to forgotten moves
DROP TRIGGER IF EXISTS delete_known_move_add_forgotten;
DELIMITER //
CREATE TRIGGER delete_known_move_add_forgotten
    AFTER DELETE ON known_moves
    FOR EACH ROW
BEGIN 
    INSERT INTO forgotten_moves (owned_pokemon_id, move_id)
    VALUES  (OLD.owned_pokemon_id, OLD.move_id);
 END; //
DELIMITER ;