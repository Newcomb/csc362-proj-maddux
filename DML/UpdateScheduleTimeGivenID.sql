-- Update sql for schedule
UPDATE schedule
SET time_taught = ?
WHERE move_id = ?;