--Allows for deletion of an owned_pokemon that the user no longer has.
DELETE owned_pokemon WHERE (owned_pokemon_id = ?);
