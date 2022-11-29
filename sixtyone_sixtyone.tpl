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

</div>


<script type="text/javascript">

// Javascript HTML templates

/*
// Example:
var jstpl_some_game_item='<div class="my_game_item" id="my_game_item_${MY_ITEM_ID}"></div>';

*/

var jstpl_sxt_player_area = 
    '<div class="sxt_player_area" id="sxt_player_area_${player_id}"> \
        <div class="sxt_player_dices_area" id="sxt_player_dices_area_${player_id}"> \
            <div class="sxt_dice" id="sxt_dice_${player_id}_1"></div> \
            <div class="sxt_dice" id="sxt_dice_${player_id}_2"></div> \
            <div class="sxt_dice" id="sxt_dice_${player_id}_3"></div> \
        </div> \
        <div class="sxt_player_board" id="sxt_player_board_${player_id}"> \
        </div> \
    </div>';

var jstpl_sxt_leave = '<div class="sxt_leave" id="sxt_leave_${player_id}_${leave_id}"></div>';

</script>  

{OVERALL_GAME_FOOTER}
