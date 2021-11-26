-- Update sql for schedule
UPDATE schedule
SET move_id = ?
WHERE move_id = ?;