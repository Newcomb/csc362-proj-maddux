/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a validation table that lists all PokemonIDs and their associated PokemonNames.

  Created 10-31-21
*/


/*Make the table*/
CREATE TABLE pokedex (
    PRIMARY KEY (pokemon_id),
    pokemon_id      INT AUTO_INCREMENT,
    pokemon_name    VARCHAR(12)
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number
INSERT INTO pokedex (pokemon_name)
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


*/