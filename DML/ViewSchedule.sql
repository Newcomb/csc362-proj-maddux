/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the view table for schedule*/
CREATE VIEW schedule AS
SELECT move_id, when_taught, teaching_duration, offered, move_name, type_id, type_name
    FROM schedule INNER JOIN moves
        ON (move_id)
    FROM moves INNER JOIN types
        ON (type_id);