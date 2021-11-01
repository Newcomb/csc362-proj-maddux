/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a data table that lists what moves are taught, when they are taught, 
  how long they are taught, and whether they are currently offered.

  Created 11-01-21
*/

/*Make sure the correct db is being used*/
USE pokemon_db;

/*Make the table*/
CREATE TABLE Schedule (
    MoveID              INT NOT NULL,
    WhenTaught          DATETIME,
    TeachingDuration    INT NOT NULL,
    Offered             BIT NOT NULL,
    FOREIGN KEY MoveID REFERENCES Moves.MoveID
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number*/
/*INSERT INTO Schedule (MoveID, WhenTaught, TeachingDuration, Offered)
VALUES();*/