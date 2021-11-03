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
    move_id              INT NOT NULL,
    when_taught          DATETIME,
    teaching_duration    INT NOT NULL,
    offered              BIT NOT NULL,
    FOREIGN KEY (move_id) REFERENCES moves(move_id) ON DELETE RESTRICT
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number*/
/*INSERT INTO Schedule (MoveID, WhenTaught, TeachingDuration, Offered)
VALUES();*/
