<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SixtyOne implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 * 
 * states.inc.php
 *
 * SixtyOne game states description
 *
 */

/*
   Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
   in a very easy way from this configuration file.

   Please check the BGA Studio presentation about game state to understand this, and associated documentation.

   Summary:

   States types:
   _ activeplayer: in this type of state, we expect some action from the active player.
   _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
   _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
   _ manager: special type for initial and final state

   Arguments of game states:
   _ name: the name of the GameState, in order you can recognize it on your own code.
   _ description: the description of the current game state is always displayed in the action status bar on
                  the top of the game. Most of the time this is useless for game state with "game" type.
   _ descriptionmyturn: the description of the current game state when it's your turn.
   _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
   _ action: name of the method to call when this game state become the current game state. Usually, the
             action method is prefixed by "st" (ex: "stMyGameStateName").
   _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
                      method on both client side (Javacript: this.checkAction) and server side (PHP: self::checkAction).
   _ transitions: the transitions are the possible paths to go from a game state to another. You must name
                  transitions in order to use transition names in "nextState" PHP method, and use IDs to
                  specify the next game state for each transition.
   _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
           client side to be used on "onEnteringState" or to set arguments in the gamestate description.
   _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
                            method).
*/

//    !! It is not a good idea to modify this file when a game is running !!

if (!defined('STATE_INIT_GAME')) { // ensure this block is only invoked once, since it is included multiple times
    define("STATE_INIT_GAME", 1);
    define("STATE_INIT_TURN", 10);
    define("STATE_INIT_MULTI", 20);
    define("STATE_CHOOSE_AREA", 30);
    define("STATE_CHOOSE_DIE", 40);
    define("STATE_CHOOSE_DIE_LOCATION", 50);
    define("STATE_LAST_DIE_SCORE", 60);
    define("STATE_CHOOSE_CROSS_LOCATION", 70);
    define("STATE_AREA_SCORING", 80);
    define("STATE_NEXT_TURN", 90);
    define("STATE_END_GAME", 99);
}

$machinestates = array(

    // The initial state. Please do not modify.
    STATE_INIT_GAME => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array( "" => STATE_INIT_TURN )
    ),

    STATE_INIT_TURN => array(
        "name" => "initTurn",
        "description" => "",
        "type" => "game",
        "action" => "stInitTurn",
        "transitions" => array( "" => STATE_INIT_MULTI )
    ),

    STATE_INIT_MULTI => array(
        "name" => "multiplayerPhase",
        "description" => clienttranslate('Waiting for other players to end their turn.'),
        "descriptionmyturn" => clienttranslate('${you} must do your turn'), // Won't be displayed anyway since each private state has its own description
        "type" => "multipleactiveplayer",
        "initialprivate" => STATE_CHOOSE_AREA, // This makes this state a master multiactive state and enables private states, this is also a first private state
        "action" => "stMultiplayerPhase",
        "args" => "argMultiplayerPhase",
        //"possibleactions" => ["changeMind"], //this action is possible if player is not in any private state which usually happens when they are inactive
        "transitions" => array( "" => STATE_AREA_SCORING ) // this is normal next transition which will happen after all players finish their turns 
    ),

    STATE_CHOOSE_AREA => array(
        "name" => "chooseArea",
        "description" => "",
        "descriptionmyturn" => clienttranslate('${you} must choose an area, or pass.'),
        "type" => "private",
        "args" => "argChooseArea",
        "possibleactions" => array( "pass", "chooseArea" ),
        "transitions" => array( "passed" => 70, "areaChosen" => STATE_CHOOSE_DIE )
    ),

    STATE_CHOOSE_DIE => array(
        "name" => "chooseDie",
        "description" => "",
        "descriptionmyturn" => clienttranslate('${you} must choose a die.'),
        "type" => "private",
        "args" => "argChooseDie",
        "possibleactions" => array( "chooseDie", "cancelAreaChoice" ),
        "transitions" => array( 
            "toDieLocationChoice" => STATE_CHOOSE_DIE_LOCATION, 
            "toLastDieScoring" => STATE_LAST_DIE_SCORE, 
            "areaChoiceCancelled" => STATE_CHOOSE_AREA 
        )
    ),

    STATE_CHOOSE_DIE_LOCATION => array(
        "name" => "chooseDieLocation",
        "description" => "",
        "descriptionmyturn" => clienttranslate('${you} must choose a location.'),
        "type" => "private",
        "args" => "argChooseDieLocation",
        "possibleactions" => array( "chooseDieLocation", "cancelDieChoice" ),
        "transitions" => array( "dieLocationChosen" => STATE_LAST_DIE_SCORE, "dieChoiceCancelled" => STATE_CHOOSE_AREA )
    ),

    STATE_LAST_DIE_SCORE => array(
        "name" => "lastDieScore",
        "description" => "",
        "type" => "game",
        "action" => "stLastDieScore",
        "transitions" => array( "toCrossLocationChoice" => STATE_CHOOSE_CROSS_LOCATION, "toAreaScoring" => STATE_AREA_SCORING )
    ),

    STATE_CHOOSE_CROSS_LOCATION => array(
        "name" => "chooseCrossLocation",
        "description" => "",
        "descriptionmyturn" => clienttranslate('${you} must choose a location for the joker.'),
        "type" => "private",
        "args" => "argChooseCrossLocation",
        "possibleactions" => array( "chooseCrossLocation", "cancelDieLocation" ),
        "transitions" => array( "crossLocationChosen" => STATE_AREA_SCORING, "dieLocationCancelled" => STATE_CHOOSE_AREA )
    ),

    STATE_AREA_SCORING => array(
        "name" => "areaScoring",
        "description" => '',
        "type" => "game",
        "action" => "stAreaScoring",
        "transitions" => array( "nextRound" => 120 )
    ),
    
/*
    Examples:
    
    2 => array(
        "name" => "nextPlayer",
        "description" => '',
        "type" => "game",
        "action" => "stNextPlayer",
        "updateGameProgression" => true,   
        "transitions" => array( "endGame" => 99, "nextPlayer" => 10 )
    ),
    
    10 => array(
        "name" => "playerTurn",
        "description" => clienttranslate('${actplayer} must play a card or pass'),
        "descriptionmyturn" => clienttranslate('${you} must play a card or pass'),
        "type" => "activeplayer",
        "possibleactions" => array( "playCard", "pass" ),
        "transitions" => array( "playCard" => 2, "pass" => 2 )
    ), 

*/    
   
    // Final state.
    // Please do not modify (and do not overload action/args methods).
    STATE_END_GAME => array(
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    )

);



