/*Make sure the correct db is being used*/
USE pokemon_db;

/*Make the table*/
CREATE TABLE ForgottenMoves (
    OwnedPokemonID      INT NOT NULL,
    MoveID              INT NOT NULL,
    FOREIGN KEY OwnedPokemonID REFERENCES OwnedPokemon.OwnedPokemonID,
    FOREIGN KEY MoveID REFERENCES Moves.MoveID
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number*/
/*INSERT INTO ForgottenMoves (OwnedPokemonID, MoveID)
VALUES();*/