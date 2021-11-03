CREATE TABLE known_moves
(
    owned_pokemon_id    INT NOT NULL,
    move_id             INT NOT NULL,
    FOREIGN KEY (owned_pokemon_id) REFERENCES owned_pokemon(owned_pokemon_id),
    FOREIGN KEY (move_id) REFERENCES moves(move_id),
    PRIMARY KEY (move_id, owned_pokemon_id)

)
