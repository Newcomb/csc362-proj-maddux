CREATE TABLE known_moves
(
    ownedpokemon_id INT NOT NULL,
    move_id INT AUTO_INCREMENT NOT NULL,

    FOREIGN KEY moves REFERENCES moves(move_id),
    FOREIGN KEY owned_pokemon REFERENCES owned_pokemon(owned_pokemon_id),
    
    -- Setting up primary key
    PRIMARY KEY (move_id, owned_pokemon_id)

);
