--Allow for insertion of a new move into known moves using php
INSERT INTO known_moves (owned_pokemon_id, move_id)
VALUES (?, ?);
