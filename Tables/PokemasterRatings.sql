-- SQL for creating pokemaster ratings table
CREATE TABLE pokemaster_ratings (
    PRIMARY KEY (pokemaster_ratings_id),
    pokemaster_ratings_id   INT NOT NULL AUTO_INCREMENT,
    pokemaster_id           INT NOT NULL,
    move_id                 INT NOT NULL,
    star_rating             INT CHECK (star_rating > 0 AND star_rating < 6),
    FOREIGN KEY (move_id) REFERENCES moves (move_id)
    ON DELETE RESTRICT,
    FOREIGN KEY (pokemaster_id) REFERENCES pokemasters (pokemaster_id) 
    ON DELETE RESTRICT,
    UNIQUE (pokemaster_id, move_id)
);
