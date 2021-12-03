-- Create function that returns the hidden status of a move
DROP FUNCTION IF EXISTS getHiddenStat;
CREATE FUNCTION getHiddenStat (moveID INT) 
RETURNS INT
RETURN (SELECT COUNT(hidden_move) FROM moves WHERE (move_id = moveID AND hidden_move = 1));