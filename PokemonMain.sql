/*
    Move Tutor Database
    Team JMAN
    Minh Vu

    

    Created 11-1-21
*/

/*Make the main script to source all sql tables*/
DROP DATABASE IF EXISTS pokemon_db;
CREATE DATABASE pokemon_db;

USE pokemon_db;

-- Source all sql files
SOURCE Tables/Pokemasters.sql;
SOURCE Tables/Types.sql;
SOURCE Tables/Moves.sql;
SOURCE Tables/Pokedex.sql;
SOURCE Tables/OwnedPokemon.sql;
SOURCE Tables/Schedule.sql;
SOURCE Tables/PokemonTypes.sql;
SOURCE Tables/KnownMoves.sql;
SOURCE Tables/ForgottenMoves.sql;
SOURCE Tables/RatingCounts.sql; 
SOURCE Tables/PokemasterRatings.sql;

-- Add values to the table
SOURCE Tables/TableValues.sql;

-- Generate views
SOURCE DML/ViewForgottenMoves.sql;
SOURCE DML/ViewKnownMoves.sql;
SOURCE DML/ViewOwnedPokemon.sql;
SOURCE DML/ViewPokedex.sql;
SOURCE DML/ViewPokemasterRatings.sql;
SOURCE DML/ViewPokemasters.sql;
SOURCE DML/ViewRatingCounts.sql;
SOURCE DML/ViewTypes.sql;
SOURCE DML/V_OwnedPokemonJoin.sql;
SOURCE DML/V_Moves_Types_Join.sql;
SOURCE DML/V_Known_Moves_Join.sql;
SOURCE DML/V_Forgotten_Moves_Join.sql;
SOURCE DML/V_Pokemon_Types_Join.sql;
SOURCE DML/V_Schedule.sql;
SOURCE DML/V_Pokedex.sql;



-- Load Functions
SOURCE DML/F_Get_Owned_Pokemon_Type.sql;
SOURCE DML/F_Get_Move_Type.sql;
SOURCE DML/F_Check_If_Hidden.sql;

-- Load Triggers
SOURCE DML/T_Check_Type_Match_Or_Normal_Insert.sql;
SOURCE DML/T_Stop_Hidden_Move_Update.sql;
SOURCE DML/T_Check_Known_Moves_Min.sql;
SOURCE DML/T_Check_Known_Moves_Max.sql;
SOURCE DML/T_Remove_Forgotten_Move_If_Taught.sql;
SOURCE DML/T_Delete_Known_Move_Add_Forgotten.sql;
SOURCE DML/T_Check_Type_Match_Or_Normal_Update.sql;
SOURCE DML/T_Check_Type_Match_Or_Normal_Forgotten_Update.sql;
SOURCE DML/T_Check_Type_Match_Or_Normal_Insert_Forgotten.sql;
SOURCE DML/T_Pokemon_Types_Max.sql;
SOURCE DML/T_Remove_Forgotten_Move_If_Taught_Update.sql;
SOURCE DML/T_Update_Known_Move_Add_Forgotten.sql;
SOURCE DML/T_Check_Delete_Pokemon_Type.sql;