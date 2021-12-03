/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the view table for schedule*/
DROP VIEW IF EXISTS schedule_join;
CREATE VIEW schedule_join AS
SELECT schedule_id AS 'Schedule ID', move_id AS 'Move ID', move_name AS 'move_name', type_id AS 'Type ID', type_name AS 'Type Name', date_taught AS 'Date Taught', time_taught AS 'Time Taught', teaching_duration AS 'Teaching Duration', offered AS 'Offered'
    FROM schedule 
    INNER JOIN moves
        USING (move_id)
    INNER JOIN types
        USING (type_id);
