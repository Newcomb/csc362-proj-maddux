-- Update sql for schedule
UPDATE schedule
SET date_taught = ?
WHERE move_id = ?;