/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for pokemon types*/
CREATE TABLE pokemon_types (
    PRIMARY KEY (pokemon_types_id),
    pokemon_types_id    INT NOT NULL AUTO_INCREMENT,
    pokemon_id          INT NOT NULL,
    type_id             INT NOT NULL,
    FOREIGN KEY (pokemon_id) REFERENCES pokedex(pokemon_id) ON DELETE RESTRICT,
    FOREIGN KEY (type_id) REFERENCES types(type_id) ON DELETE RESTRICT,
    UNIQUE (pokemon_id, type_id)
);