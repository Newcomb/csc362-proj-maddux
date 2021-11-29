CREATE TABLE known_moves
(
    PRIMARY KEY (known_moves_id),
    known_moves_id      INT NOT NULL AUTO_INCREMENT,
    owned_pokemon_id    INT NOT NULL,
    move_id             INT NOT NULL,
    FOREIGN KEY (owned_pokemon_id) REFERENCES owned_pokemon(owned_pokemon_id),
    FOREIGN KEY (move_id) REFERENCES moves(move_id),
    UNIQUE (owned_pokemon_id, move_id)
);
