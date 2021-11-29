-- This trigger will prevent hidden moves from being deleted 
DROP TRIGGER IF EXISTS stop_hidden_move_deletion;
DELIMITER //
CREATE TRIGGER stop_hidden_move_deletion
    BEFORE UPDATE ON known_moves
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(move_id) FROM known_moves_join WHERE (known_move_id = OLD.known_move_id AND hidden_move = 1)) = 1 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot Delete: Hidden moves cannot be deleted by Bill.';
    END IF;
 END; //
DELIMITER ;