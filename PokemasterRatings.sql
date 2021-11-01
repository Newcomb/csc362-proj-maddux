--SQL for creating pokemaster ratings table
CREATE TABLE pokemaster_ratings (
    pokemaster_id           INT,
    move_id                 INT,
    star_rating             INT,
    FOREIGN KEY (move_id) REFERENCES moves (move_id)
    ON DELETE RESTRICT,
    CONSTRAINT pokemaster_ratings_id PRIMARY KEY (pokemaster_id, move_id)
);
