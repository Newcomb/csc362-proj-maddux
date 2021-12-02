-- Prepared SQL for Schedule injection question marks will be filled in using php
INSERT INTO schedule (move_id, date_taught, time_taught, teaching_duration, offered)
VALUES (?, ?, ?, ?, ?);