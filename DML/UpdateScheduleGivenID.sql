-- Update sql for schedule
UPDATE schedule
SET move_id = ?
WHERE schedule_id = ?;