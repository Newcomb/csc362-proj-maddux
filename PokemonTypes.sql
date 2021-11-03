/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for pokemon types*/
CREATE TABLE pokemon_types (
    pokemon_id      INT NOT NULL,
    type_id         INT NOT NULL,
    FOREIGN KEY pokemon_id REFERENCES Pokedex.pokemon_id ON DELETE RESTRICT,
    FOREIGN KEY type_id REFERENCES Types.type_id ON DELETE RESTRICT
);