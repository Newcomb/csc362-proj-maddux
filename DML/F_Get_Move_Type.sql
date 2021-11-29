-- Create function that returns the type of a move
DROP FUNCTION IF EXISTS getMoveType;
CREATE FUNCTION getMoveType (moveID INT) 
RETURNS INT
RETURN (SELECT type_id FROM moves WHERE (move_id = moveID));