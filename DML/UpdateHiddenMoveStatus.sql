-- Changes hidden move status of a given move
UPDATE moves 
SET hidden_move = ?
WHERE (move_id = ?);