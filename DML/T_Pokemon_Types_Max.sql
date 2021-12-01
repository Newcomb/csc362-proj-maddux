-- This trigger prevents more than two types being assigned to a pokemon
DROP TRIGGER IF EXISTS check_pokemon_types_max;
DELIMITER //
CREATE TRIGGER check_pokemon_types_max
    BEFORE INSERT ON pokemon_types
    FOR EACH ROW
BEGIN
    IF (SELECT COUNT(pokemon_id) FROM pokemon_types WHERE (pokemon_id = NEW.pokemon_id)) = 2 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot Insert: This pokemon has the maximum amount of types.';
    END IF;
 END; //
DELIMITER ;