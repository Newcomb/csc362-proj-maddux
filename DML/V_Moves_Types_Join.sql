DROP VIEW IF EXISTS moves_types_join;
--Number of routes at each difficulty at every crag
CREATE VIEW moves_types_join AS
SELECT move_id, move_name, type_name, taught_status, hidden_move
FROM moves
INNER JOIN types USING (type_id)
ORDER BY (move_id);