CREATE TABLE moves
(
    PRIMARY KEY (move_id),
    move_id         INT NOT NULL AUTO_INCREMENT,
    move_name       VARCHAR(50) NOT NULL,
    hidden_move     VARCHAR(10) NOT NULL,
    taught_status   VARCHAR(11) NOT NULL,
    type_id         INT NOT NULL,
    FOREIGN KEY (type_id) REFERENCES types (type_id) ON DELETE RESTRICT
)
