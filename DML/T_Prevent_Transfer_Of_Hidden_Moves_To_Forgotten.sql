-- This trigger prevents unlinking of type from pokemon when pokemon has a move of that type
DROP TRIGGER IF EXISTS prevent_transfer_of_hidden;
DELIMITER //
CREATE TRIGGER prevent_transfer_of_hidden
    BEFORE INSERT ON forgotten_moves
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(hidden_move) FROM moves WHERE (move_id = NEW.move_id AND hidden_move = 1)) != 0 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Deletion completed but the move was not inserted to forgotten moves because it was a hidden move';
    END IF;
 END; //
DELIMITER ;