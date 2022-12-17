{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- SixtyOne implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------

    sixtyone_sixtyone.tpl
    
    This is the HTML template of your game.
    
    Everything you are writing in this file will be displayed in the HTML page of your game user interface,
    in the "main game zone" of the screen.
    
    You can use in this template:
    _ variables, with the format {MY_VARIABLE_ELEMENT}.
    _ HTML block, with the BEGIN/END format
    
    See your "view" PHP file to check how to set variables and control blocks
    
    Please REMOVE this comment before publishing your game on BGA
-->


<div id="sxt_game_area">
    <div  id="sxt_dice_area" class="sxt_dice_area">
        <div id="sxt_die_1" class="sxt_die"></div>
        <div id="sxt_die_2" class="sxt_die"></div>
        <div id="sxt_die_3" class="sxt_die"></div>
    </div>
</div>


<script type="text/javascript">

// Javascript HTML templates

/*
// Example:
var jstpl_some_game_item='<div class="my_game_item" id="my_game_item_${MY_ITEM_ID}"></div>';

*/

var jstpl_sxt_player_area = 
    '<div id="sxt_player_area_${player_id}" class="sxt_player_area"> \
        <div id="sxt_player_name_${player_id}" class="sxt_player_name"></div> \
        <div id="sxt_player_board_${player_id}" class="sxt_player_board"> \
        </div> \
    </div>';

var jstpl_sxt_leave = '<div class="sxt_leave" id="sxt_leave_${player_id}_${leave_id}"></div>';

var jstpl_sxt_bonus = '<div class="sxt_bonus sxt_bonus_${bonus_id} sxt_bonus_acquired_${bonus_id}" id="sxt_bonus_${player_id}_${bonus_id}"></div>';

var jstpl_sxt_area = '<div id="sxt_area_${player_id}_${area_id}" class="sxt_area sxt_area_${area_id}"></div>';

var jstpl_sxt_area_status = '<div id="sxt_area_status_${player_id}_${area_id}" class="sxt_area_status"></div>';

var jstpl_sxt_location_area_1 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_1_${size}"></div>';
var jstpl_sxt_location_area_2 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_2"></div>';
var jstpl_sxt_location_area_3 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_3 sxt_location_area_3_${side}"></div>';
var jstpl_sxt_location_area_4 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_4"></div>';
var jstpl_sxt_location_area_5 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_5"></div>';
var jstpl_sxt_location_area_6 = '<div id="sxt_location_${player_id}_${area_id}_${location_id}" class="sxt_location sxt_location_area_6"></div>';

var jstpl_sxt_score = '<div id="sxt_score_${player_id}_${id}" class="sxt_score"></div>';

</script>  

{OVERALL_GAME_FOOTER}
