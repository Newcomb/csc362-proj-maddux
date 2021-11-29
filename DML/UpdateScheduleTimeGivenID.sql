-- Update sql for schedule
UPDATE schedule
SET when_taught = ?
WHERE move_id = ?;