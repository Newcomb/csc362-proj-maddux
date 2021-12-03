-- Update sql for schedule
UPDATE schedule
SET time_taught = ?
WHERE schedule_id = ?;