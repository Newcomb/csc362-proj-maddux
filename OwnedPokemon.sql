/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for owned pokemon*/
CREATE TABLE owned_pokemon (
    pokemaster_id       INT NOT NULL,
    pokemon_id          INT NOT NULL,
    FOREIGN KEY pokemaster_id REFERENCES PokeMaster.pokemaster_id ON DELETE RESTRICT,
    FOREIGN KEY pokemon_id REFERENCES Pokedex.pokemon_id ON DELETE RESTRICT,
    CONSTRAINT owned_pokemon_id PRIMARY KEY (pokemaster_id, pokemon_id)
);