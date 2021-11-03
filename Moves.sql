-- creating the moves table

CREATE TABLE moves
(
    moveID INT AUTO_INCREMENT NOT NULL,
    move_name VARCHAR(50) NOT NULL,
    --move_type VARCHAR (50) NOT NULL,
    type_id INT NOT NULL AUTO_INCREMENT,
    hidden_move VARCHAR (10) NOT NULL,
    taught_status  VARCHAR (11) NOT NULL,
    FOREIGN KEY (Types) REFERENCES Types(type_id),
    PRIMARY KEY(move_id)
);
