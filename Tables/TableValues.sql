-- Insert values for the pokedex
INSERT INTO pokedex (pokemon_name)
VALUES  ('Bulbasaur'),
        ('Ivysaur'),
        ('Venusaur'),
        ('Charmander'),
        ('Charmeleon'),
        ('Charizard'),
        ('Squirtle'),
        ('Wartortle'),
        ('Blastoise'),
        ('Caterpie'),
        ('Metapod'),
        ('Butterfree');

INSERT INTO types (type_name)
VALUES  ('Normal'),
        ('Fire'),
        ('Water'),
        ('Grass'),
        ('Electric'),
        ('Ice'),
        ('Fighting'),
        ('Poison'),
        ('Ground'),
        ('Flying'),
        ('Psychic'),
        ('Bug'),
        ('Rock'),
        ('Ghost'),
        ('Dark'),
        ('Dragon'),
        ('Steel'),
        ('Fairy');

INSERT INTO pokemon_types (pokemon_id, type_id)
VALUES  (1, 4),
        (1, 8),
        (2, 4),
        (2, 8),
        (3, 4),
        (3, 8),
        (4, 2),
        (5, 2),
        (6, 2),
        (6, 10),
        (7, 3),
        (8, 3),
        (9, 3),
        (10, 12),
        (11, 12),
        (12, 12),
        (12, 10);

INSERT INTO pokemasters (pokemaster_first_name, pokemaster_last_name)
VALUES  ('Josh', 'West'),
        ('Newcomb', 'Maddux'),
        ('Minh', 'Vu'),
        ('AJ', 'Howell');

INSERT INTO owned_pokemon (pokemaster_id, pokemon_id)
VALUES  (1, 4),
        (1, 12),
        (2, 9),
        (2, 2),
        (3, 10),
        (3, 4),
        (4, 11),
        (4, 8);

INSERT INTO moves (move_name, hidden_move, taught_status, type_id)
VALUES  ('Absorb', 0, 0, 4),
        ('Acid', 0, 0, 8),
        ('Bite', 0, 0, 15),
        ('Blizzard', 0, 0, 6),
        ('Body Slam', 0, 0, 1),
        ('Charge Beam', 0, 0, 5),
        ('Curse', 0, 0, 14),
        ('Dive', 1, 0, 3),
        ('Dragon Breath', 0, 0, 15);
