/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for owned pokemon*/
CREATE TABLE owned_pokemon (
    PRIMARY KEY         (owned_pokemon_id),
    owned_pokemon_id    INT AUTO_INCREMENT,
    pokemaster_id       INT NOT NULL,
    pokemon_id          INT NOT NULL,
    FOREIGN KEY pokemaster_id REFERENCES PokeMaster.pokemaster_id,
    FOREIGN KEY pokemon_id REFERENCES Pokedex.pokemon_id
);