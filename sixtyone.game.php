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
  * sixtyone.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );

require_once( 'modules/php/includes/SXTAutoLoader.inc.php' );

use PhobyJuan\SixtyOne\Managers\SXTPlayerManager;

use PhobyJuan\SixtyOne\Objects\SXTPlayer;


class SixtyOne extends Table
{
	function __construct( )
	{
        // Your global variables labels:
        //  Here, you can assign labels to global variables you are using for this game.
        //  You can use any number of global variables with IDs between 10 and 99.
        //  If your game has options (variants), you also have to associate here a label to
        //  the corresponding ID in gameoptions.inc.php.
        // Note: afterwards, you can get/set the global variables with getGameStateValue/setGameStateInitialValue/setGameStateValue
        parent::__construct();
        
        self::initGameStateLabels( array( 
            //    "my_first_global_variable" => 10,
            //    "my_second_global_variable" => 11,
            //      ...
            //    "my_first_game_variant" => 100,
            //    "my_second_game_variant" => 101,
            //      ...

            "die_1_value" => 10,
            "die_2_value" => 11,
            "die_3_value" => 12,
        ) );

        $this->playerManager = new SXTPlayerManager();
	}
	
    protected function getGameName( )
    {
		// Used for translations and stuff. Please do not modify.
        return "sixtyone";
    }	

    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    protected function setupNewGame( $players, $options = array() )
    {    
        // Set the colors of the players with HTML color code
        // The default below is red/green/blue/orange/brown
        // The number of colors defined here must correspond to the maximum number of players allowed for the gams
        $gameinfos = self::getGameinfos();
        $default_colors = $gameinfos['player_colors'];
 
        // Create players
        // Note: if you added some extra field on "player" table in the database (dbmodel.sql), you can initialize it there.
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach( $players as $player_id => $player )
        {
            $color = array_shift( $default_colors );
            $values[] = "('".$player_id."','$color','".$player['player_canal']."','".addslashes( $player['player_name'] )."','".addslashes( $player['player_avatar'] )."')";
        }
        $sql .= implode( ',', $values );
        self::DbQuery( $sql );
        self::reattributeColorsBasedOnPreferences( $players, $gameinfos['player_colors'] );
        self::reloadPlayersBasicInfos();
        
        /************ Start the game initialization *****/

        // Init global values with their initial values
        $this->setGameStateInitialValue( "die_1_value", null );
        $this->setGameStateInitialValue( "die_2_value", null );
        $this->setGameStateInitialValue( "die_3_value", null );
        
        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here
       

        // Activate first player (which is in general a good idea :) )
        $this->activeNextPlayer();

        /************ End of the game initialization *****/
    }

    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */
    protected function getAllDatas()
    {
        $result = array();
    
        $current_player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
    
        // Get information about players
        // Note: you can retrieve some extra field you added for "player" table in "dbmodel.sql" if you need it.
        $sql = "SELECT player_id id, player_score score, 
                    die_1, die_2, die_3,
                    score_area_1, score_area_2, score_area_3, score_area_4, score_area_5, score_area_6, 
                    area_1_1, area_1_2, area_1_3, area_1_4, 
                    area_2_1, area_2_2, area_2_3, area_2_4, area_2_5, 
                    area_3_1_1, area_3_1_2, area_3_2_1, area_3_2_2, area_3_2_3, 
                    area_4_1, area_4_2, area_4_3, area_4_4, area_4_5, area_4_6, 
                    area_5_1, area_5_2, area_5_3, area_5_4, area_5_5, area_5_6, 
                    area_6_1, area_6_2, area_6_3, area_6_4, area_6_5 
                FROM player ";
        $result['players'] = self::getCollectionFromDb( $sql );
  
        // TODO: Gather all information about current game situation (visible by player $current_player_id).

        for ($i=1; $i<4; $i++) {
            $result['dice'] = $this->getDiceDatas() ;
        }
  
        return $result;
    }

    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */
    function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */
    function getDiceDatas() 
    {
        $result = array();
    
        for ($i=1; $i<4; $i++) {
            $result[$i] = $this->getGameStateValue( "die_".$i."_value" );
        }

        return $result;
    }

    function getFirstAvailableLocation(SXTPlayer $player, int $area_id)
    {
        $res = -1;
        switch ($area_id) {
            case 2:
                
            case 6:
                $area = $player->getArea_2();
                for ($i=0; $i<=4; $i++) {
                    if ($area[$i] == null) {
                        $res = $i;
                    }
                }
                break;

            default:
                break;
        }

        return $res;
    }

    function getAvailableLocations(SXTPlayer $player, int $area_id, int $dice_value)
    {
        $res = [];

        switch ($area_id) {
            case 1:
                $area = $player->getArea_1();
                if ($area[0] == null && $area[1] == null) {
                    $res[] = 1;
                    $res[] = 2;
                } else if ($area[0] != null) {
                    if ($dice_value == $area[0]) {
                        $res[] = 2;
                    }
                } else {
                    if ($dice_value == $area[1]) {
                        $res[] = 1;
                    }
                }

                if ($area[2] == null && $area[3] == null) {
                    $res[] = 3;
                    $res[] = 4;
                } else if ($area[2] != null) {
                    if ($dice_value == $area[2]) {
                        $res[] = 4;
                    }
                } else {
                    if ($dice_value == $area[3]) {
                        $res[] = 3;
                    }
                }

                break;
                
            case 2:
                $area = $player->getArea_2();
                $i = 0;
                $found = false;
                while ($i <= 4  && !$found) {
                    if ($area[$i] == null) {
                        $found = true;
                    }
                }
                if ($found) {
                    if ($i > 0) {
                        if ($area[$i-1] != $dice_value) {
                            $res[] = $i+1;
                        }
                    } else {
                        $res[] = 1;
                    }
                }

                break;

            case 3:
                $area = $player->getArea_3();
                if ($area[0][0] == null && $area[0][1] == null) {
                    // $res[] = '1_1';
                    // $res[] = '1_2';
                    $res[] = '1';
                    $res[] = '2';
                } else if ($area[0][0] == null) {
                    if ($area[0][1] == $dice_value) {
                        // $res[] = '1_1';
                        $res[] = '1';
                    }
                } else {
                    if ($area[0][0] == $dice_value) {
                        // $res[] = '1_2';
                        $res[] = '2';
                    }
                }

                if ($area[1][0] == null && $area[1][1] == null && $area[1][2] == null) {
                    // $res[] = '2_1';
                    // $res[] = '2_2';
                    // $res[] = '2_3';
                    $res[] = '3';
                    $res[] = '4';
                    $res[] = '5';
                } else if ($area[1][0] == null && $area[1][1] == null) {
                    if ($area[1][2] == $dice_value) {
                        // $res[] = '2_1';
                        // $res[] = '2_2';
                        $res[] = '3';
                        $res[] = '4';
                    }
                } else if ($area[1][1] == null && $area[1][2] == null) {
                    if ($area[1][0] == $dice_value) {
                        // $res[] = '2_2';
                        // $res[] = '2_3';
                        $res[] = '4';
                        $res[] = '5';
                    }
                } else if ($area[1][2] == null && $area[1][0] == null) {
                    if ($area[1][1] == $dice_value) {
                        // $res[] = '2_3';
                        // $res[] = '2_1';
                        $res[] = '5';
                        $res[] = '3';
                    }
                } else if ($area[1][0] == null) {
                    if ($area[1][1] == $dice_value) {
                        // $res[] = '2_1';
                        $res[] = '3';
                    }
                } else if ($area[1][1] == null) {
                    if ($area[1][2] == $dice_value) {
                        // $res[] = '2_2';
                        $res[] = '4';
                    }
                } else if ($area[1][2] == null) {
                    if ($area[1][0] == $dice_value) {
                        // $res[] = '2_3';
                        $res[] = '5';
                    }
                }

                break;

            case 4:
                $area = $player->getArea_4();
                if ($area[$dice_value-1] == null) {
                    $res[] = $dice_value;
                }

                break;
            
            // Area 5 locations:
            //    6           5 
            //   4 5         3 4
            //  1 2 3       0 1 2
            case 5:
                $area = $player->getArea_5();
                if ($area[0] == null) {
                    if ($area[1] != $dice_value) {
                        $res[] = 1;
                    }
                }
                if ($area[1] == null) {
                    if ($area[0] != $dice_value && $area[2] != $dice_value) {
                        $res[] = 2;
                    }
                }
                if ($area[2] == null) {
                    if ($area[2] != $dice_value) {
                        $res[] = 3;
                    }
                }
                if ($area[3] == null && ($area[0] != null && $area[1] != null)) {
                    if ($area[0] != $dice_value && $area[1] != $dice_value) {
                        $res[] = 4;
                    }
                }
                if ($area[4] == null && ($area[1] != null && $area[2] != null)) {
                    if ($area[1] != $dice_value && $area[2] != $dice_value) {
                        $res[] = 5;
                    }
                }
                if ($area[5] == null && ($area[3] != null && $area[4] != null)) {
                    if ($area[3] != $dice_value && $area[4] != $dice_value) {
                        $res[] = 6;
                    }
                }

                break;

            case 6:
                $area = $player->getArea_6();
                $i = 0;
                $found = false;
                while ($i <= 4  && !$found) {
                    if ($area[$i] == null) {
                        $found = true;
                    }
                }
                if ($found) {
                    if ($i > 0) {
                        if (abs($area[$i-1] - $dice_value) == 1) {
                            $res[] = $i+1;
                        }
                    } else {
                        $res[] = 1;
                    }
                }
                break;

            default:
                break;
        }

        return $res;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    /*
        Each time a player is doing some game action, one of the methods below is called.
        (note: each method below must match an input method in sixtyone.action.php)
    */

    /*
    
    Example:

    function playCard( $card_id )
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'playCard' ); 
        
        $player_id = self::getActivePlayerId();
        
        // Add your game logic to play a card there 
        ...
        
        // Notify all players about the card played
        self::notifyAllPlayers( "cardPlayed", clienttranslate( '${player_name} plays ${card_name}' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ) );
          
    }
    
    */

    function chooseArea($area_id) 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseArea' ); 
        
        $player_id = self::getCurrentPlayerId();
        
        self::debug("******************************");
        self::debug($player_id);
        self::debug($area_id);
        self::debug($this->getGameStateValue( "die_1_value" ));
        self::debug($this->getGameStateValue( "die_2_value" ));
        self::debug($this->getGameStateValue( "die_3_value" ));

        $die_id = 0;
        if ($this->getGameStateValue( "die_1_value" ) == $area_id) {
            self::debug("1 --- " . $area_id . ", " . $this->getGameStateValue( "die_1_value" ));
            $die_id = 1;
        } else if ($this->getGameStateValue( "die_2_value" ) == $area_id) {
            self::debug("2 --- " . $area_id . ", " . $this->getGameStateValue( "die_2_value" ));
            $die_id = 2;
        } else {
            self::debug("3 --- " . $area_id . ", " . $this->getGameStateValue( "die_3_value" ));
            $die_id = 3;
        }

        $player = $this->playerManager->getById($player_id);
        $player->setDie_1($die_id);
        $this->playerManager->persist($player);

        
        // // Notify all players about the card played
        // self::notifyAllPlayers( "cardPlayed", clienttranslate( '${player_name} plays ${card_name}' ), array(
        //     'player_id' => $player_id,
        //     'player_name' => self::getActivePlayerName(),
        //     'card_name' => $card_name,
        //     'card_id' => $card_id
        // ) );

        $this->gamestate->nextPrivateState($player_id, "areaChosen"); 
    }

    function chooseDie($die_id) 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseDie' ); 
        
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);
        $player->setDie_2($die_id);
        $this->playerManager->persist($player);

        switch ($die_id) {
            case 1:

            case 3:

            case 5:

                $next_state = "toDieLocationChoice";
                break;

            case 2:

            case 4:

            case 6:

                $next_state = "toLastDieScoring";
                break;
            
            default:
                break;
        }

        //$this->gamestate->nextPrivateState($player_id, $next_state); 

        $this->gamestate->nextPrivateState($player_id, "toDieLocationChoice"); 
    }

    function chooseDieLocation($area_id, $location_id)
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseDieLocation' ); 
                
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $die_id = $player->getDie_2();
        $die_value = $this->getGameStateValue( "die_".$die_id."_value" );
        if ($area_id != 3) {
            $player->{"setArea_".$area_id."_".$location_id}($die_value);
        } else {
            $location_id_1 = 0;
            $location_id_2 = 0;
            if ($location_id < 3) {
                $location_id_1 = 1;
                $location_id_2 = $location_id;
            } else {
                $location_id_1 = 2;
                $location_id_2 = $location_id - 2;
            }
            $player->{"setArea_".$area_id."_".$location_id_1."_".$location_id_2}($die_value);
        }
        
        $this->playerManager->persist($player);

        self::notifyPlayer( $player_id, "locationChosen", clienttranslate("You placed a ${die_value} in aera ${area_id}"), array(
            'die_value' => $die_value,
            'area_id' => $area_id,
            'location_id' => $location_id,
        ) );

        // 3rd die
        $used_dice = [false, false, false];
        $used_dice[$player->getDie_1()] = true;
        $used_dice[$player->getDie_2()] = true;
        $remaining_die_id = 0;
        for ($i=0; $i<3; $i++) {
            if (!$used_dice[$i]) {
                $remaining_die_id = ($i+1);
            }
        }

        $player->setDie_3($remaining_die_id);
        

        if ($remaining_die_id) {
            $player->add_leave_score($this->getGameStateValue( "die_".$remaining_die_id."_value" )); 
        }

        $this->playerManager->persist($player);

        $player_total_leave_score = $player->get_total_score_leave();

        self::dump("player: ", $player);

        if ($remaining_die_id) {
            $third_die_value = $this->getGameStateValue( "die_".$remaining_die_id."_value" );
            $score_leave_last_position = $player->get_score_leave_last_position();

            self::notifyPlayer( $player_id, "addLeaveScore", "", array(
                'total_score_leave' => $player_total_leave_score,
                'leave_number' => $score_leave_last_position,
            ) );
        }

        //$this->gamestate->nextPrivateState($player_id, "dieLocationChosen"); 
    }
    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    /*
        Here, you can create methods defined as "game state arguments" (see "args" property in states.inc.php).
        These methods function is to return some additional information that is specific to the current
        game state.
    */

    /*
    
    Example for game state "MyGameState":
    
    function argMyGameState()
    {
        // Get some values from the current game situation in database...
    
        // return values:
        return array(
            'variable1' => $value1,
            'variable2' => $value2,
            ...
        );
    }    
    */
    function argMultiplayerPhase()
    {
        return $this->getDiceDatas();
    }

    function argChooseArea() 
    {
        $dice = $this->getDiceDatas();
        
        $res = [];
        for ($i=1; $i<4; $i++) {
            if (!array_search($dice[$i], $res)) {

                $res[count($res) + 1] = $dice[$i];
            }
        }

        return $res;
    }

    function argChooseDie() 
    {
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $die_id = $player->getDie_1();
        $res = ['die_id' => $die_id];

        if ($die_id) {
            $die_value = $this->getGameStateValue( "die_".$die_id."_value" );
            $res['die_value'] = $die_value;
        }
        
        return $res;
    }

    function argChooseDieLocation()
    {
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $area_die_id = $player->getDie_1();
        $location_die_id = $player->getDie_2();

        $getAvailableLocations = true;

        $area_id = -1;
        $dice_value = -1;

        if ($area_die_id) {
            $area_id = $this->getGameStateValue( "die_".$area_die_id."_value" );
        } else {
            $getAvailableLocations = false;
        }
        
        if ($location_die_id) {
            $dice_value = $this->getGameStateValue( "die_".$location_die_id."_value" );
        } else {
            $getAvailableLocations = false;
        }
        
        $res = [];

        if ($getAvailableLocations) {
            $res['area_id'] = $area_id;
            $res['locations'] = $this->getAvailableLocations($player, $area_id, $dice_value);
        }
        
        return $res;
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

    /*
        Here, you can create methods defined as "game state actions" (see "action" property in states.inc.php).
        The action method of state X is called everytime the current game state is set to X.
    */
    
    /*
    
    Example for game state "MyGameState":

    function stMyGameState()
    {
        // Do some stuff ...
        
        // (very often) go to another gamestate
        $this->gamestate->nextState( 'some_gamestate_transition' );
    }    
    */

    function stInitTurn() 
    {
        // Dice roll
        for ($i=1; $i<4; $i++) {
            $this->setGameStateValue( "die_".$i."_value", bga_rand(1, 6) );
        }

        $this->gamestate->nextState("");
    }

    function stMultiplayerPhase()
    {
        $this->gamestate->setAllPlayersMultiactive();
        
        //this is needed when starting private parallel states; players will be transitioned to initialprivate state defined in master state
        $this->gamestate->initializePrivateStateForAllActivePlayers();

        return;
    }

    function stLastDieScore()
    {
        $this->gamestate->nextPrivateState($player_id, "toAreaScoring"); 
    }

    function stAreaScoring()
    {
        $this->gamestate->nextPrivateState($player_id, "nextRound"); 
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
    	$statename = $state['name'];
    	
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//


    }    
}
