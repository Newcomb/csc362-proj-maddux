--Creates view of moves and their corresponding type ids and type names.
CREATE VIEW move_types AS
SELECT move_id, move_name, type_id, type_name
FROM moves
INNER JOIN types
ON (type_id);