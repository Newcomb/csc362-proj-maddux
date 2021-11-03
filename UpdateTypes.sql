-- Update the types table
UPDATE types
SET type_name = ?
WHERE type_id = ?;