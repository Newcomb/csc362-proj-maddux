/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a data table that lists what moves are taught, when they are taught, 
  how long they are taught, and whether they are currently offered.

  Created 11-01-21
*/


/*Make the table*/
CREATE TABLE schedule (
    schedule_id          INT NOT NULL AUTO_INCREMENT,
    move_id              INT NOT NULL,
    date_taught          DATE NOT NULL,
    time_taught          TINYINT(1) NOT NULL,
    -- teaching_duration    INT NOT NULL,
    -- offered              TINYINT(1) NOT NULL,
    PRIMARY KEY (schedule_id),
    FOREIGN KEY (move_id) REFERENCES moves(move_id) ON DELETE RESTRICT,
    CONSTRAINT entry_already_booked UNIQUE (date_taught, time_taught)
);
