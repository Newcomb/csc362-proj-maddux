/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the view table for schedule*/
DROP VIEW IF EXISTS schedule_join;
CREATE VIEW schedule_join AS
SELECT schedule_id, move_id, date_taught, time_taught, teaching_duration, offered, move_name, type_id, type_name
    FROM schedule INNER JOIN moves
        USING (move_id)
    INNER JOIN types
        USING (type_id);
