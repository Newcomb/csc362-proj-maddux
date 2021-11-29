/*
  Move Tutor Database
  Team JMAN
  Josh West

  The script creates a linking table connecting the OwnedPokemon and Moves tables.

  Created 11-01-21
*/

/*Make the table*/
CREATE TABLE forgotten_moves (
    PRIMARY KEY (forgotten_moves_id),
    forgotten_moves_id    INT NOT NULL AUTO_INCREMENT,
    owned_pokemon_id      INT NOT NULL,
    move_id              INT NOT NULL,
    FOREIGN KEY (owned_pokemon_id) REFERENCES owned_pokemon(owned_pokemon_id) ON DELETE RESTRICT,
    FOREIGN KEY (move_id) REFERENCES moves(move_id) ON DELETE RESTRICT,
    UNIQUE (owned_pokemon_id, move_id)
);

/*Fill the table with values (according to national pokedex)
link: https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number*/
/*INSERT INTO ForgottenMoves (OwnedPokemonID, MoveID)
VALUES();*/
