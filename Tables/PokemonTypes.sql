/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for pokemon types*/
CREATE TABLE pokemon_types (
    pokemon_id      VARCHAR(12) NOT NULL,
    type_id         INT NOT NULL,
    FOREIGN KEY (pokemon_id) REFERENCES pokedex(pokemon_id) ON DELETE RESTRICT,
    FOREIGN KEY (type_id) REFERENCES types(type_id) ON DELETE RESTRICT,
    CONSTRAINT pokemon_type_id PRIMARY KEY (pokemon_id, type_id)
);