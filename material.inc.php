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
 * material.inc.php
 *
 * SixtyOne game material description
 *
 * Here, you can describe the material of your game with PHP variables.
 *   
 * This file is loaded in your game logic class constructor, ie these variables
 * are available everywhere in your game logic code.
 *
 */


/*

Example:

$this->card_types = array(
    1 => array( "card_name" => ...,
                ...
              )
);

*/

$this->bonus = array(
    // 1 => 0,
    // 2 => 0,
    // 3 => 0,
    // 4 => 0,
    // 5 => 0,
    // 6 => 0,
    // 7 => 0,
    // 8 => 0,
    // 9 => 0,
    // 10 => 0,
    11 => 0, // 0 => cross to place, otherwise nb PV
    21 => 2,
    31 => 0, 
    41 => 3,
    51 => 0,
    61 => 5,
);

$this->area_size = array(
    1 => 4,
    2 => 5,
    3 => 5,
    4 => 6,
    5 => 6,
    6 => 5,
);

$this->score_area_state = array(
    "MISSED" => -1,
    "AVAILABLE" => 0,
    "COMPLETED" => 3,
);

$this->location_score = array(
    1 => array(1 => 3, 2 => 3),
    2 => array(1 => 1, 2 => 1, 3 => 2, 4 => 2, 5 => 3),
    3 => array(1 => 3, 2 => 5),
    4 => array(1 => 1, 2 => 1, 3 => 1, 4 => 2, 5 => 1, 6 => 1),
    5 => array(1 => 1, 2 => 1, 3 => 1, 4 => 2, 5 => 2, 6 => 4),
    6 => array(1 => 1, 2 => 2, 3 => 2, 4 => 2, 5 => 3),
);