-- This trigger prevents unlinking of type from pokemon when pokemon has a move of that type
DROP TRIGGER IF EXISTS check_delete_pokemon_type;
DELIMITER //
CREATE TRIGGER check_delete_pokemon_type
    BEFORE DELETE ON pokemon_types
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(known_move_id) FROM known_moves INNER JOIN moves USING (move_id) WHERE (type_id = OLD.type_id)) != 0 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot Delete: The link you tried to delete is being used.';
    END IF;
 END; //
DELIMITER ;