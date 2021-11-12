/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the view for individual view of schedule*/
CREATE VIEW move_schedule AS
SELECT move_id, when_taught, teaching_duration, offered, move_name, type_id, type_name
    FROM moves LEFT JOIN schedule
        ON (move_id)
    FROM moves INNER JOIN types
        ON (type_id);