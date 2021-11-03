--Prepared SQL for Schedule injection 
--question marks will be filled in using php.
INSERT INTO schedule (move_id, when_taught, teaching_duration, offered)
VALUES (?, ?, ?, ?);