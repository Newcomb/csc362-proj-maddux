/*Make sure the correct db is being used*/
USE move_tutor;

/*Make the table*/
CREATE TABLE Pokedex (
    PRIMARY KEY (PokemonID),
    PokemonID      INT AUTO_INCREMENT,
    PokemonName    VARCHAR(12)
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number*/
INSERT INTO Pokedex (PokemonName)
VALUES('Bulbasaur',
'Ivysaur',
'Venusaur',
'Charmander',
'Charmeleon',
'Charizard',
'Squirtle',
'Wartortle',
'Blastoise',
'Caterpie',
'Metapod',
'Butterfree');