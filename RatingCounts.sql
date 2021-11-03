--SQL file for creating rating counts table
CREATE TABLE rating_counts (
    PRIMARY KEY (rating_count_id),
    rating_count_id     INT NOT NULL AUTO_INCREMENT,
    raing_count         INT,
    move_id             INT NOT NULL,
    FOREIGN KEY (move_id) REFERENCES moves (move_id)
    ON DELETE RESTRICT
);
