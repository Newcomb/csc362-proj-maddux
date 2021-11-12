/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the table for pokemasters*/
CREATE TABLE pokemasters (
    PRIMARY KEY               (pokemaster_id),
    pokemaster_id             INT AUTO_INCREMENT,
    pokemaster_first_name     VARCHAR(50),
    pokemaster_last_name      VARCHAR(50)
);

-- INSERT INTO pokemasters (pokemaster_first_name)
-- VALUES (
--     ''
-- )