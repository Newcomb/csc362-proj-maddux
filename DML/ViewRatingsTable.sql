CREATE VIEW ratings_table AS
SELECT pokemaster_id, move_name, star_rating
FROM pokemaster_ratings
INNER JOIN moves
ON (move_id);