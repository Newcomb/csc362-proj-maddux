--Deletion sql for schedule
DELETE FROM schedule WHERE (move_id = ? AND when_taught = ?);
