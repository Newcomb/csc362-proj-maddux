/*Delete from the table*/
CREATE FUNCTION del_select(item AS INT)
RETURNS 
DELETE * FROM pokedex WHERE pokemon_id = item;