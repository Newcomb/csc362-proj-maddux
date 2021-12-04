DROP VIEW IF EXISTS Count_Rating;
CREATE VIEW Count_Rating AS 
SELECT move_name as "Move Name", COUNT(star_rating) as "Total Rating", SUM(star_rating)/COUNT(star_rating) AS "Average Rating"
FROM pokemaster_ratings 
INNER JOIN moves USING (move_id)
GROUP BY (move_id)
ORDER BY (SUM(star_rating)/COUNT(star_rating)) DESC;