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
    11 => 0,
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
    5 => 5,
    6 => 5,
);
