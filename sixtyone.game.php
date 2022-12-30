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
            "area_1_completed" => 13,
            "area_2_completed" => 14,
            "area_3_completed" => 15,
            "area_4_completed" => 16,
            "area_5_completed" => 17,
            "area_6_completed" => 18,
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
        $this->setGameStateInitialValue( "area_1_completed", false );
        $this->setGameStateInitialValue( "area_2_completed", false );
        $this->setGameStateInitialValue( "area_3_completed", false );
        $this->setGameStateInitialValue( "area_4_completed", false );
        $this->setGameStateInitialValue( "area_5_completed", false );
        $this->setGameStateInitialValue( "area_6_completed", false );
        
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
                    die_1, die_2, die_3, chosen_location, chosen_area_cross, chosen_location_cross, gained_bonus,
                    score_leave_1, score_leave_2, score_leave_3, score_leave_4, score_leave_5, 
                    score_leave_6, score_leave_7, score_leave_8, score_leave_9, score_leave_10,
                    score_leave_11, score_leave_12, score_leave_13, score_leave_14, score_leave_15,
                    score_leave_16, score_leave_17, score_leave_18, score_leave_19, score_leave_20,
                    score_area_1, score_area_2, score_area_3, score_area_4, score_area_5, score_area_6, 
                    area_1_1, area_1_2, area_1_3, area_1_4, 
                    area_2_1, area_2_2, area_2_3, area_2_4, area_2_5, 
                    area_3_1, area_3_2, area_3_3, area_3_4, area_3_5, 
                    area_4_1, area_4_2, area_4_3, area_4_4, area_4_5, area_4_6, 
                    area_5_1, area_5_2, area_5_3, area_5_4, area_5_5, area_5_6, 
                    area_6_1, area_6_2, area_6_3, area_6_4, area_6_5,
                    bonus_1, bonus_2, bonus_3, bonus_4, bonus_5, bonus_6
                FROM player ";
        $result['players'] = self::getCollectionFromDb( $sql );
  
        // TODO: Gather all information about current game situation (visible by player $current_player_id).

        for ($i=1; $i<4; $i++) {
            $result['dice'] = $this->getDiceDatas() ;
        }

        $result['score_area_state'] = $this->score_area_state;
        $result['area_size'] = $this->area_size;
  
        $players = $result['players'];
        foreach ($players as $player_id => $info) {
            $player = $this->playerManager->getById($player_id);
            $result['players'][$player_id]['leave_counter'] = $player->get_total_score_leave();
            // $result['counters']=[
            // $result['counters']=[
            //     'leave' => [ 
            //     'counter_name' => 'leave_'.$player_id, 
            //     'counter_value' => $player->get_total_score_leave(),
            //     ],
            // ];
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
        $players = $this->loadPlayersBasicInfos();

        $game_progression = 0;

        foreach ($players as $player_id => $info) {
            $player = $this->playerManager->getById($player_id);

            // progression according to leaves score
            $total_score_leave = $player->get_total_score_leave();
            if ($total_score_leave > 0) {
                $tmp1 = (($total_score_leave / 61) * 100);
            } else {
                $tmp1 = 0;
            }
            
            // progression according to turn number
            $leave_last_position = $player->get_score_leave_last_position();
            if ($leave_last_position > 0) {
                $tmp2 = (($leave_last_position / 20) * 100);
            } else {
                $tmp2 = 0;
            }

            $game_progression = max($game_progression, max($tmp1, $tmp2));
            
            if ($game_progression > 100) {
                $game_progression = 100;
            }
        }

        return $game_progression;
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

    // function getFirstAvailableLocation(SXTPlayer $player, int $area_id)
    // {
    //     $res = -1;
    //     switch ($area_id) {
    //         case 2:
                
    //         case 6:
    //             $area = $player->getArea_2();
    //             for ($i=0; $i<=4; $i++) {
    //                 if ($area[$i] == null) {
    //                     $res = $i;
    //                 }
    //             }
    //             break;

    //         default:
    //             break;
    //     }

    //     return $res;
    // }

    function getAvailableLocations(SXTPlayer $player, int $area_id, int $die_value)
    {
        $res = [];

        switch ($area_id) {
            case 1:
                $area = $player->getArea_1();
                if ($area[0] == -1 && $area[1] == -1) {
                    $res[] = 1;
                    $res[] = 2;
                } else if ($area[0] != -1) {
                    if (($die_value == $area[0] || $die_value == 0 || $area[0] == 0) && $area[1] == -1) {
                        $res[] = 2;
                    }
                } else {
                    if (($die_value == $area[1] || $die_value == 0 || $area[1] == 0) && $area[0] == -1) {
                        $res[] = 1;
                    }
                }

                if ($area[2] == -1 && $area[3] == -1) {
                    $res[] = 3;
                    $res[] = 4;
                } else if ($area[2] != -1) {
                    if (($die_value == $area[2] || $die_value == 0 || $area[2] == 0) && $area[3] == -1) {
                        $res[] = 4;
                    }
                } else {
                    if (($die_value == $area[3] || $die_value == 0 || $area[3] == 0) && $area[2] == -1) {
                        $res[] = 3;
                    }
                }

                break;
                
            case 2:
                $area = $player->getArea_2();
                $i = 0;
                $found = false;
                $already_exists = false;
                while ($i <= 4  && !$found && !$already_exists) {
                    if ($area[$i] == -1) {
                        $found = true;
                    } else if ($area[$i] == $die_value && $die_value != 0) {
                        $already_exists = true;
                    } else {
                        $i++;
                    }
                }
                if ($found && !$already_exists) {
                    if ($i > 0) {
                        if (($area[$i-1] != $die_value || $die_value == 0 || $area[$i-1] == 0) && $area[$i] == -1) {
                            $res[] = $i+1;
                        }
                    } else {
                        $res[] = 1;
                    }
                }

                break;

            case 3:
                $area = $player->getArea_3();
                if ($area[0] == -1 && $area[1] == -1) {
                    $res[] = '1';
                    $res[] = '2';
                } else if ($area[0] == -1) {
                    if (($area[1] == $die_value || $die_value == 0 || $area[1] == 0) && $area[0] == -1) {
                        $res[] = '1';
                    }
                } else {
                    if (($area[0] == $die_value || $die_value == 0 || $area[0] == 0) && $area[1] == -1) {
                        $res[] = '2';
                    }
                }

                if ($area[2] == -1 && $area[3] == -1 && $area[4] == -1) {
                    $res[] = '3';
                    $res[] = '4';
                    $res[] = '5';
                } else if ($area[2] == -1 && $area[3] == -1) {
                    if (($area[4] == $die_value) || ($area[4] == 0) || ($die_value == 0)) {
                        $res[] = '3';
                        $res[] = '4';
                    }
                } else if ($area[3] == -1 && $area[4] == -1) {
                    if (($area[2] == $die_value) || ($area[2] == 0) || ($die_value == 0)) {
                        $res[] = '4';
                        $res[] = '5';
                    }
                } else if ($area[4] == -1 && $area[2] == -1) {
                    if (($area[3] == $die_value) || ($area[3] == 0) || ($die_value == 0)) {
                        $res[] = '5';
                        $res[] = '3';
                    }
                } else if ($area[2] == -1) {
                    if (($area[3] == $die_value && $area[4] == $die_value)
                            || ($area[3] == 0 && $area[4] == $die_value)
                            || ($area[3] == $die_value && $area[4] == 0)
                            || ($area[3] == 0 && $area[4] == 0)
                            || ($die_value == 0)) {
                        $res[] = '3';
                    }
                } else if ($area[3] == -1) {
                    if (($area[2] == $die_value && $area[4] == $die_value)
                            || ($area[2] == 0 && $area[4] == $die_value)
                            || ($area[2] == $die_value && $area[4] == 0)
                            || ($area[2] == 0 && $area[4] == 0)
                            || ($die_value == 0)) {
                        $res[] = '4';
                    }
                } else if ($area[4] == -1) {
                    if (($area[2] == $die_value && $area[3] == $die_value)
                            || ($area[2] == 0 && $area[3] == $die_value)
                            || ($area[2] == $die_value && $area[3] == 0)
                            || ($area[2] == 0 && $area[3] == 0)
                            || ($die_value == 0)) {
                        $res[] = '5';
                    }
                }

                break;

            case 4:
                $area = $player->getArea_4();
                if ($die_value > 0) {
                    if ($area[$die_value-1] == -1) {
                        $res[] = $die_value;
                    }
                } else {
                    for ($i=0; $i<6; $i++) {
                        if ($area[$i] == -1) {
                            $res[] = ($i+1);
                        }
                    }
                }

                break;
                
            // Area 5 locations:
            //    6           5 
            //   4 5         3 4
            //  1 2 3       0 1 2
            case 5:
                $area = $player->getArea_5();
                // self::dump("area 5 : ", $area);
                if ($area[0] == -1) {
                    if ($area[1] != $die_value || $die_value == 0 || $area[1] == 0) {
                        $res[] = 1;
                    }
                }
                if ($area[1] == -1) {
                    if (($area[0] != $die_value && $area[2] != $die_value) 
                            || ($area[0] == 0 && $area[2] == 0)
                            || ($area[0] == 0 && $area[2] != $die_value)
                            || ($area[0] != $die_value && $area[2] == 0)
                            || ($die_value == 0)) {
                        $res[] = 2;
                    }
                }
                if ($area[2] == -1) {
                    if ($area[1] != $die_value || $die_value == 0 || $area[1] == 0) {
                        $res[] = 3;
                    }
                }
                if ($area[3] == -1 && ($area[0] != -1 && $area[1] != -1)) {
                    if (($area[0] != $die_value && $area[1] != $die_value)
                            || ($area[0] == 0 && $area[1] == 0)
                            || ($area[0] == 0 && $area[1] != $die_value)
                            || ($area[0] != $die_value && $area[1] == 0)
                            || ($die_value == 0)) {
                        $res[] = 4;
                    }
                }
                if ($area[4] == -1 && ($area[1] != -1 && $area[2] != -1)) {
                    if (($area[1] != $die_value && $area[2] != $die_value)
                            || ($area[1] == 0 && $area[2] == 0)
                            || ($area[1] == 0 && $area[2] != $die_value)
                            || ($area[1] != $die_value && $area[2] == 0)
                            || ($die_value == 0)) {
                        $res[] = 5;
                    }
                }
                if ($area[5] == -1 && ($area[3] != -1 && $area[4] != -1)) {
                    if (($area[3] != $die_value && $area[4] != $die_value)
                            || ($area[3] == 0 && $area[4] == 0)
                            || ($area[3] == 0 && $area[4] != $die_value)
                            || ($area[3] != $die_value && $area[2] == 0)
                            || ($die_value == 0)) {
                        $res[] = 6;
                    }
                }

                break;

            case 6:
                $area = $player->getArea_6();
                $i = 0;
                $found = false;
                while ($i <= 4  && !$found) {
                    if ($area[$i] == -1) {
                        $found = true;
                    } else {
                        $i++;
                    }
                }
                if ($found) {
                    if ($i > 0) {
                        if ((abs($area[$i-1] - $die_value) == 1 || $die_value == 0 || $area[$i-1] == 0) && $area[$i] == -1
                            || ($die_value == 1 && $area[$i-1] == 6) || ($die_value == 6 && $area[$i-1] == 1)) {
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

    function getPossibleMoves(SXTPlayer $player) 
    {
        $res = array();

        for ($i=1; $i<4; $i++) {
            $area_id = $this->getGameStateValue( "die_".$i."_value" );
            if ($i == 1) {
                $res[$area_id][$this->getGameStateValue( "die_2_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_2_value" ));
                $res[$area_id][$this->getGameStateValue( "die_3_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_3_value" ));
            } else if ($i == 2) {
                $res[$area_id][$this->getGameStateValue( "die_3_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_3_value" ));
                $res[$area_id][$this->getGameStateValue( "die_1_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_1_value" ));
            } else if ($i == 3) {
                $res[$area_id][$this->getGameStateValue( "die_1_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_1_value" ));
                $res[$area_id][$this->getGameStateValue( "die_2_value" )] = $this->getAvailableLocations($player, $area_id, $this->getGameStateValue( "die_2_value" ));
            }
        }

        return $res;
    }

    function getPossibleMovesNumber(SXTPlayer $player) 
    {
        $possibleMoveNumber = 0;

        $possibleMoves = $this->getPossibleMoves($player);

        foreach ($possibleMoves as $possibleMove) {
            foreach ($possibleMove as $possibleLocation) {
                $possibleMoveNumber += count($possibleLocation);
            }
        }

        return $possibleMoveNumber;
    }

    function check_area_completion_for_player(SXTPlayer $player, int $area_id)
    {
        $locations = $player->{'getArea_'.$area_id}();
        $filled_location = 0;

        foreach ($locations as $location) {
            if ($location > -1) {
                $filled_location++;
            }
        }

        self::debug("------------------------");
        self::dump('filled_location : ', $filled_location);
        self::dump('size : ', $this->area_size[$area_id]);
        if ($filled_location == $this->area_size[$area_id]) {
            $score_area = $player->getScore_area();
            $score_area[$area_id-1] = $this->score_area_state["COMPLETED"];
            $player->setScore_area($score_area);

            $this->playerManager->persist($player);
        }
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

        $player = $this->playerManager->getById($player_id);

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

    function cancelAreaChoice()
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'cancelAreaChoice' ); 
        
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);
        $player->setDie_1(null);
        $this->playerManager->persist($player);

        self::notifyPlayer( $player_id, "cancelLocationChosen", "", array() );

        $this->gamestate->nextPrivateState($player_id, "areaChoiceCancelled");
    }

    function pass() 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'pass' ); 

        $player_id = self::getCurrentPlayerId();

        $this->gamestate->nextPrivateState($player_id, "passed");
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

    function cancelDieChoice() 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'cancelDieChoice' ); 
        
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);
        $player->setDie_1(null);
        $player->setDie_2(null);
        $this->playerManager->persist($player);

        self::notifyPlayer( $player_id, "cancelDieChosen", "", array() );

        $this->gamestate->nextPrivateState($player_id, "dieChoiceCancelled");
    }

    function chooseDieLocation($area_id, $location_id)
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseDieLocation' ); 
                
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $die_id = $player->getDie_2();
        $die_value = $this->getGameStateValue( "die_".$die_id."_value" );
        // if ($area_id != 3) {
            $player->{"setArea_".$area_id."_".$location_id}($die_value);


        // } else {
        //     $location_id_1 = 0;
        //     $location_id_2 = 0;
        //     if ($location_id < 3) {
        //         $location_id_1 = 1;
        //         $location_id_2 = $location_id;
        //     } else {
        //         $location_id_1 = 2;
        //         $location_id_2 = $location_id - 2;
        //     }
        //     $player->{"setArea_".$area_id."_".$location_id_1."_".$location_id_2}($die_value);
        // }
        
        $player->setChosen_location($location_id);

        $this->playerManager->persist($player);

        self::notifyPlayer( $player_id, "locationChosen", clienttranslate('${player_name} placed a ${sxt_log_dice} in aera ${sxt_log_area}.'), array(
            'die_value' => $die_value,
            'area_id' => $area_id,
            'location_id' => $location_id,
            'player_name' => self::getCurrentPlayerName(),
            'sxt_log_dice' => $die_value,
            'sxt_log_area' => $area_id,
        ) );

        // 3rd die
        $used_dice = [false, false, false];
        $used_dice[$player->getDie_1() - 1] = true;
        $used_dice[$player->getDie_2() - 1] = true;
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

        // self::dump("player: ", $player);

        if ($remaining_die_id) {
            $third_die_value = $this->getGameStateValue( "die_".$remaining_die_id."_value" );
            $score_leave_last_position = $player->get_score_leave_last_position();

            self::notifyPlayer( $player_id, "addLeaveScore", "", array(
                'total_score_leave' => $player_total_leave_score,
                'leave_number' => $score_leave_last_position,
            ) );
        }

        // area completed ?
        if (!$this->getGameStateValue( 'area_'.$area_id.'_completed' )) {
            $this->check_area_completion_for_player($player, $area_id);
        }
        
        // Next state
        // Cross to write, or not ?
        // + other bonus ?
        if (array_key_exists($player_total_leave_score, $this->bonus)) {
            $index = array_search($player_total_leave_score, array_keys($this->bonus));
            $player->setGained_bonus($index + 1);
            $bonus = $player->getBonus();
            $bonus[$index] = $this->bonus[$player_total_leave_score];
            $player->setBonus($bonus);
            $this->playerManager->persist($player);

            self::notifyPlayer( $player_id, "gainBonus", "", array(
                'gained_bonus_id' => ($index + 1),
            ) );

            if ($this->bonus[$player_total_leave_score] == 0) {
                $this->gamestate->nextPrivateState($player_id, "toCrossLocationChoice");
            } else {
                $this->gamestate->setPlayerNonMultiactive( $player_id, "" );
            }
        } else {
            $this->gamestate->setPlayerNonMultiactive( $player_id, "" );
        }
    }

    function chooseCrossLocation($area_id, $location_id) 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseCrossLocation' ); 
                        
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);
        
        $player->{"setArea_".$area_id."_".$location_id}(0);

        $player->setChosen_area_cross($area_id);
        $player->setChosen_location_cross($location_id);

        // $player->setChosen_location($location_id);

        $this->playerManager->persist($player);

        // area completed ?
        if (!$this->getGameStateValue( 'area_'.$area_id.'_completed' )) {
            $this->check_area_completion_for_player($player, $area_id);
        }

        self::notifyPlayer( $player_id, "locationChosen", clienttranslate('${player_name} placed a X in area ${sxt_log_area}.'), array(
            'die_value' => 0,
            'area_id' => $area_id,
            'location_id' => $location_id,
            'player_name' => self::getCurrentPlayerName(),
            'sxt_log_area' => $area_id,
        ) );

        $this->gamestate->setPlayerNonMultiactive( $player_id, "" );
    }

    function chooseLeaveDie($die_id) 
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'chooseLeaveDie' ); 
                                
        $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $player->setDie_3($die_id);
        
        if ($die_id) {
            $player->add_leave_score($this->getGameStateValue( "die_".$die_id."_value" )); 
        }

        $this->playerManager->persist($player);

        $player_total_leave_score = $player->get_total_score_leave();

        // self::dump("player: ", $player);

        if ($die_id) {
            $score_leave_last_position = $player->get_score_leave_last_position();

            self::notifyPlayer( $player_id, "addLeaveScore", "", array(
                'total_score_leave' => $player_total_leave_score,
                'leave_number' => $score_leave_last_position,
            ) );
        }

        // Next state
        // Cross to write, or not ?
        if (array_key_exists($player_total_leave_score, $this->bonus)) {
            $index = array_search($player_total_leave_score, array_keys($this->bonus));
            $player->setGained_bonus($index + 1);
            $bonus = $player->getBonus();
            $bonus[$index] = $this->bonus[$player_total_leave_score];
            $player->setBonus($bonus);
            $this->playerManager->persist($player);

            self::notifyPlayer( $player_id, "gainBonus", "", array(
                'gained_bonus_id' => ($index + 1),
            ) );

            if ($this->bonus[$player_total_leave_score] == 0) {
                $this->gamestate->nextPrivateState($player_id, "toCrossLocationChoice");
            } else {
                $this->gamestate->setPlayerNonMultiactive( $player_id, "" );
            }
        } else {
            $this->gamestate->setPlayerNonMultiactive( $player_id, "" );
        }
    }

    // pass() for zombie
    function zombiePass( $zombie_player_id )
    {
        $this->gamestate->unsetPrivateState($zombie_player_id);
        $this->gamestate->setPlayerNonMultiactive( $zombie_player_id, "" );
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

    function argChooseArea($current_player_id) 
    {
        $res = array();

        // PossibleMovesNumber
        // $players = $this->loadPlayersBasicInfos();

        // foreach ($players as $player_id => $info) {
        //    $player = $this->playerManager->getById($player_id);

        //     $res['possibleMovesNumber'][$player_id] = $this->getPossibleMovesNumber($player);

        //     $res['possibleMoves'][$player_id] = $this->getPossibleMoves($player);

        //     self::dump('possibleMovesNumber : ', $res['possibleMovesNumber'][$player_id]);
        // }

        $player = $this->playerManager->getById($current_player_id);
        $res['possibleMovesNumber'] = $this->getPossibleMovesNumber($player);
        $res['possibleMoves'] = $this->getPossibleMoves($player);
        
        
        $res['dice'] = array();

        $res['chooseAreaPrompt'] = clienttranslate('must pass');

        if ($res['possibleMovesNumber'] > 0) {
            // dice values available for area selection
            $res['chooseAreaPrompt'] = clienttranslate('must choose an area');

            $dice = $this->getDiceDatas();
            self::dump("+++++++++++++++++++++++ dice ", $dice);
            for ($i=1; $i<4; $i++) {
                if (!array_search($dice[$i], $res['dice'])) {
                    $res['dice'][count($res['dice']) + 1] = $dice[$i];
                }
            }
        }
        
        return $res;
    }

    function argChooseDie($player_id) 
    {
        // $player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        $die_id = $player->getDie_1();
        $res = ['die_id' => $die_id];

        if ($die_id) {
            $die_value = $this->getGameStateValue( "die_".$die_id."_value" );
            $res['die_value'] = $die_value;
        }
        
        return $res;
    }

    function argChooseDieLocation(int $player_id)
    {
        //$player_id = self::getCurrentPlayerId();

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

    function argChooseCrossLocation(int $player_id)
    {
        //$player_id = self::getCurrentPlayerId();

        $player = $this->playerManager->getById($player_id);

        for ($i=1; $i<7; $i++) {
            $res['locations'][$i] = $this->getAvailableLocations($player, $i, 0);
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

        self::notifyAllPlayers( "rollDice", "", array(
            'die_1' => $this->getGameStateValue( "die_1_value" ),
            'die_2' => $this->getGameStateValue( "die_2_value" ),
            'die_3' => $this->getGameStateValue( "die_3_value" ),
        ) );

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
        // $this->gamestate->nextPrivateState($player_id, "toAreaScoring"); 
    }

    function stAreaScoring()
    {
        self::debug('stAreaScoring');

        // Notify other players
        $players = $this->loadPlayersBasicInfos();

        $area_completed = array();
        $area_missed = array();

        foreach ($players as $player_id => $info) {

            $player = $this->playerManager->getById($player_id);

            $player_id = $player_id;
            // if player passed, he has no die #1
            $player_die1 = $player->getDie_1();
            $area_id = null;
            if ($player_die1) {
                $area_id = $this->getGameStateValue( "die_".$player_die1."_value" );
            }
            $location_id = $player->getChosen_location();
            // if player passed, he has no die #2
            $player_die2 = $player->getDie_2();
            $die_location_value = null;
            if ($player_die2) {
                $die_location_value = $this->getGameStateValue( "die_".$player_die2."_value" );
            }
            $leave_number = $player->get_score_leave_last_position();
            $total_score_leave = $player->get_total_score_leave();
            $cross_area_id = $player->getChosen_area_cross();
            $cross_location_id = $player->getChosen_location_cross();
            $gained_bonus_id = $player->getGained_bonus();

            // Turn played
            if ($player_die1 > 0) {
                $notif_message = clienttranslate('${player_name} placed a ${sxt_log_dice} in area ${sxt_log_area}.');
            } else {
                // Turn passed
                $notif_message = clienttranslate('${player_name} passed.');
            }
            

            self::notifyAllPlayers( "showTurn", $notif_message, array(
                'player_id' => $player_id,
                'player_name' => $info['player_name'],
                'area_id' => $area_id,
                'location_id' => $location_id,
                'die_location_value' => $die_location_value,
                'leave_number' => $leave_number,
                'total_score_leave' => $total_score_leave,
                'cross_area_id' => $cross_area_id,
                'cross_location_id' => $cross_location_id,
                'gained_bonus_id' => $gained_bonus_id,
                'sxt_log_dice' => $die_location_value,
                'sxt_log_area' => $area_id,
            ) );

            // Check area completion
            $score_area = $player->getScore_area();

            self::notifyAllPlayers( "tmp", "", $score_area);

            for ($i=1; $i<7; $i++) {
                self::dump('Score_area : ', $this->getGameStateValue( "area_".$i."_completed"));
                if ($this->getGameStateValue( "area_".$i."_completed" ) == "0") {
                    if ($score_area[$i-1] == $this->score_area_state["COMPLETED"]) {
                        $area_completed[$i][] = $player_id;
                    }
                }
            }

            self::dump("//////////////////// ", $area_completed);
            self::notifyAllPlayers( "tmp", "", $area_completed);
        }

        $area_missed = array();
        foreach ($area_completed as $key => $value) {
            self::dump('value : ', $value);
            foreach ($players as $player_id => $info) {
                self::dump('player_id : ', $player_id);
                $index = array_search($player_id, $value);
                if ($index === false) {
                    $area_missed[$key][] = $player_id;

                    $player = $this->playerManager->getById($player_id);
                    $score_area = $player->getScore_area();
                    $score_area[$area_id-1] = $this->score_area_state["MISSED"];
                    $player->setScore_area($score_area);

                    $this->playerManager->persist($player);
                }
            }
        }
        
        self::dump('area_completed', $area_completed);
        foreach ($area_completed as $key => $value) {
            self::dump('value : ', $value);
            foreach ($value as $key1 => $value1) {
                self::debug('notif_scoreArea completed');
                self::notifyAllPlayers( "scoreArea", "", array(
                    'player_id' => $value1,
                    'area_id' => $key,
                    'state' => 'completed',
                ) );
            }
        }

        self::dump('area_missed', $area_missed);
        foreach ($area_missed as $key => $value) {
            foreach ($value as $key1 => $value1) {
                self::debug('notif_scoreArea missed');
                self::notifyAllPlayers( "scoreArea", "", array(
                    'player_id' => $value1,
                    'area_id' => $key,
                    'state' => 'missed',
                ) );
            }
        }

        foreach ($area_completed as $key => $value) {
            $this->setGameStateValue( "area_".$key."_completed", true );
        }

        $this->gamestate->nextState(""); 
    }

    function stprepareNextTurn()
    {
        $players = $this->loadPlayersBasicInfos();

        $end_game = false;

        foreach ($players as $player_id => $info) {
            $player = $this->playerManager->getById($player_id);

            $player->setDie_1(null);
            $player->setDie_2(null);
            $player->setDie_3(null);
            $player->setChosen_location(null);
            $player->setChosen_area_cross(null);
            $player->setChosen_location_cross(null);
            $player->setGained_bonus(-1);

            $this->playerManager->persist($player);

            if ($player->get_total_score_leave() >= 61 || $player->get_score_leave_last_position() == 20) {
                $end_game = true;
            }
        }

        if ($end_game) {
            $this->gamestate->nextState("goToStatsCulculation");
        } else {
            $this->gamestate->nextState("startNextRound"); 
        }
    }

    function stStatsCalculation()
    {
        $table_final_scoring = array();

        $img_score_1 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_1\"></div>";
        $img_score_2 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_2\"></div>";
        $img_score_3 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_3\"></div>";
        $img_score_4 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_4\"></div>";
        $img_score_5 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_5\"></div>";
        $img_score_6 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_6\"></div>";
        $img_score_7 = "<div class=\"sxt_img_final_scoring sxt_img_final_scoring_7\"></div>";

        $table_final_scoring[] = array("", $img_score_1, $img_score_2, $img_score_3, $img_score_4, $img_score_5, $img_score_6,
                                        $img_score_7, [ 'str' => clienttranslate('Total'), 'args' => [], 'type' => 'header' ]);

        $players = $this->loadPlayersBasicInfos();

        foreach ($players as $player_id => $info) {
            $player = $this->playerManager->getById($player_id);

            $locations = array();
            $scores = array(0, 0, 0, 0, 0, 0, 0);
            $total = 0;
            for ($i=1; $i<7; $i++) {
                $locations = $player->{"getArea_".$i}();

                self::dump("locations area ".$i." for player ".$player_id." : ", $locations);

                $score_area = $player->getScore_area();

                if ($i == 1) {
                    if ($locations[0] >= 0 && $locations[1] >= 0) {
                        $scores[$i-1] += $this->location_score[$i][1];
                        $total += $this->location_score[$i][1];
                    }
                    if ($locations[2] >= 0 && $locations[3] >= 0) {
                        $scores[$i-1] += $this->location_score[$i][2];
                        $total += $this->location_score[$i][2];
                    }
                } else if ($i == 2) {
                    for ($j=1; $j<=count($locations); $j++) {
                        if ($locations[$j-1] >= 0) {
                            $scores[$i-1] += $this->location_score[$i][$j];
                            $total += $this->location_score[$i][$j];
                        }
                    }
                } else if ($i == 3) {
                    if ($locations[0] >= 0 && $locations[1] >= 0) {
                        $scores[$i-1] += $this->location_score[$i][1];
                        $total += $this->location_score[$i][1];
                    }
                    if ($locations[2] >= 0 && $locations[3] >= 0 && $locations[4] >= 0) {
                        $scores[$i-1] += $this->location_score[$i][2];
                        $total += $this->location_score[$i][2];
                    }
                } else if ($i == 4) {
                    for ($j=1; $j<=count($locations); $j++) {
                        if ($locations[$j-1] >= 0) {
                            $scores[$i-1] += $this->location_score[$i][$j];
                            $total += $this->location_score[$i][$j];
                        }
                    }
                } else if ($i == 5) {
                    for ($j=1; $j<=count($locations); $j++) {
                        if ($locations[$j-1] >= 0) {
                            $scores[$i-1] += $this->location_score[$i][$j];
                            $total += $this->location_score[$i][$j];
                        }
                    }
                } else if ($i == 6) {
                    for ($j=1; $j<=count($locations); $j++) {
                        if ($locations[$j-1] >= 0) {
                            $scores[$i-1] += $this->location_score[$i][$j];
                            $total += $this->location_score[$i][$j];
                        }
                    }
                }

                // For completed areas
                if ($score_area[$i-1] > 0) {
                    $scores[$i-1] += 3;
                    $total += 3;
                }
            }

            // Bonus
            $scores[6] = 0;
            $bonus = $player->getBonus();
            foreach ($bonus as $value) {
                if ($value > 0) {
                    $scores[6] += $value;
                }
            }

            $total += $scores[6];

            $scores[7] = $total;

            $player->setPlayer_Score($total);
            $this->playerManager->persist($player);

            // Scores on player sheet
            $this->notifyAllPlayers( "finalScoring", "", array(
                "player_id" => $player_id,
                "scores" => $scores,
            ) );

            $table_final_scoring[] = array($info['player_name'], $scores[0], $scores[1], $scores[2], $scores[3], $scores[4], $scores[5], $scores[6], $total);
        }

        $this->notifyAllPlayers( "tableWindow", "", array(
            "id" => 'finalScoring',
            "title" => clienttranslate('Final scoring'),
            "table" => $table_final_scoring,
            "closing" => clienttranslate( 'Close' )
        ) );

        $this->gamestate->nextState(""); 
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
    	// self::debug("+++++++++++++++ ". $state['type']);
        $this->notifyAllPlayers("log", "zombie active on state $statename", []);
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
            // $this->gamestate->setPlayerNonMultiactive( $active_player, '' );

            switch ($statename) {
                case "multiplayerPhase":
                    $this->zombiePass( $active_player );
                    break;

                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }
            
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
