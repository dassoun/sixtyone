/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SixtyOne implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * sixtyone.js
 *
 * SixtyOne user interface script
 * 
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
    "dojo","dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter",
    g_gamethemeurl + "./modules/js/coord.js"
],
function (dojo, declare) {
    return declare("bgagame.sixtyone", ebg.core.gamegui, {
        constructor: function(){
            console.log('sixtyone constructor');
              
            // Here, you can init the global variables of your user interface
            // Example:
            // this.myGlobalValue = 0;

        },
        
        /*
            setup:
            
            This method must set up the game user interface according to current game situation specified
            in parameters.
            
            The method is called each time the game interface is displayed to a player, ie:
            _ when the game starts
            _ when a player refreshes the game page (F5)
            
            "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
        */
        
        setup: function( gamedatas )
        {
            console.log( "Starting game setup" );
            
            ///////////////////////////////////////////
            // Setting up player boards
            ///////////////////////////////////////////
            let array_player_board_to_place = [];

            for ( var player_id in gamedatas.players ) {
                var player = gamedatas.players[player_id];

                if ( player_id == this.player_id || this.isSpectator ) {
                    dojo.place( this.format_block('jstpl_sxt_player_area', {
                        player_id: player_id,
                    } ), $ ( 'sxt_game_area' ) );
                } else {
                    array_player_board_to_place.push(player_id);
                }
            }

            // then, the remaining player boards
            for (let i = 0; i < array_player_board_to_place.length; i++) {
                dojo.place( this.format_block('jstpl_sxt_player_area', {
                    player_id: array_player_board_to_place[i],
                } ), $ ( 'sxt_game_area' ) );
            }

            
            for ( var player_id in gamedatas.players ) {
                // leaves
                for (let i = 0; i < leave_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_leave', {
                        player_id: player_id,
                        leave_id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_leave_'+player_id+'_'+(i+1), 'sxt_player_board_'+player_id, leave_coords[i][0], leave_coords[i][1] ).play();
                }

                // locations
                // Area #1
                for (let i = 0; i < locations_area_1_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_1', {
                        player_id: player_id,
                        area_id: 1,
                        location_id: (i+1),
                        size: locations_area_1_coords[i][2],
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_1_'+(i+1), 'sxt_player_board_'+player_id, locations_area_1_coords[i][0], locations_area_1_coords[i][1] ).play();
                }

                // Area #2
                for (let i = 0; i < locations_area_2_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_2', {
                        player_id: player_id,
                        area_id: 2,
                        location_id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_2_'+(i+1), 'sxt_player_board_'+player_id, locations_area_2_coords[i][0], locations_area_2_coords[i][1] ).play();
                }

                // Area #3
                for (let i = 0; i < locations_area_3_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_3', {
                        player_id: player_id,
                        area_id: 3,
                        location_id: (i+1),
                        side: locations_area_3_coords[i][2],
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_3_'+(i+1), 'sxt_player_board_'+player_id, locations_area_3_coords[i][0], locations_area_3_coords[i][1] ).play();
                }

                // Area #4
                for (let i = 0; i < locations_area_4_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_4', {
                        player_id: player_id,
                        area_id: 4,
                        location_id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_4_'+(i+1), 'sxt_player_board_'+player_id, locations_area_4_coords[i][0], locations_area_4_coords[i][1] ).play();
                }

                // Area #5
                for (let i = 0; i < locations_area_5_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_5', {
                        player_id: player_id,
                        area_id: 5,
                        location_id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_5_'+(i+1), 'sxt_player_board_'+player_id, locations_area_5_coords[i][0], locations_area_5_coords[i][1] ).play();
                }

                // Area #6
                for (let i = 0; i < locations_area_6_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_location_area_6', {
                        player_id: player_id,
                        area_id: 6,
                        location_id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_location_'+player_id+'_6_'+(i+1), 'sxt_player_board_'+player_id, locations_area_6_coords[i][0], locations_area_6_coords[i][1] ).play();
                }
            }

            ///////////////////////////////////////////
            // TODO: Set up your game interface here, according to "gamedatas"
            ///////////////////////////////////////////
            
 
            // Setup game notifications to handle (see "setupNotifications" method below)
            this.setupNotifications();

            console.log( "Ending game setup" );
        },
       

        ///////////////////////////////////////////////////
        //// Game & client states
        
        // onEnteringState: this method is called each time we are entering into a new game state.
        //                  You can use this method to perform some user interface changes at this moment.
        //
        onEnteringState: function( stateName, args )
        {
            console.log( 'Entering state: '+stateName );
            
            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Show some HTML block at this game state
                dojo.style( 'my_html_block_id', 'display', 'block' );
                
                break;
           */
           
           
            case 'dummmy':
                break;
            }
        },

        // onLeavingState: this method is called each time we are leaving a game state.
        //                 You can use this method to perform some user interface changes at this moment.
        //
        onLeavingState: function( stateName )
        {
            console.log( 'Leaving state: '+stateName );
            
            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Hide the HTML block we are displaying only during this game state
                dojo.style( 'my_html_block_id', 'display', 'none' );
                
                break;
           */
           
           
            case 'dummmy':
                break;
            }               
        }, 

        // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
        //                        action status bar (ie: the HTML links in the status bar).
        //        
        onUpdateActionButtons: function( stateName, args )
        {
            console.log( 'onUpdateActionButtons: '+stateName );
                      
            if( this.isCurrentPlayerActive() )
            {            
                switch( stateName )
                {
/*               
                 Example:
 
                 case 'myGameState':
                    
                    // Add 3 action buttons in the action status bar:
                    
                    this.addActionButton( 'button_1_id', _('Button 1 label'), 'onMyMethodToCall1' ); 
                    this.addActionButton( 'button_2_id', _('Button 2 label'), 'onMyMethodToCall2' ); 
                    this.addActionButton( 'button_3_id', _('Button 3 label'), 'onMyMethodToCall3' ); 
                    break;
*/
                }
            }
        },        

        ///////////////////////////////////////////////////
        //// Utility methods
        
        /*
        
            Here, you can defines some utility methods that you can use everywhere in your javascript
            script.
        
        */


        ///////////////////////////////////////////////////
        //// Player's action
        
        /*
        
            Here, you are defining methods to handle player's action (ex: results of mouse click on 
            game objects).
            
            Most of the time, these methods:
            _ check the action is possible at this game state.
            _ make a call to the game server
        
        */
        
        /* Example:
        
        onMyMethodToCall1: function( evt )
        {
            console.log( 'onMyMethodToCall1' );
            
            // Preventing default browser reaction
            dojo.stopEvent( evt );

            // Check that this action is possible (see "possibleactions" in states.inc.php)
            if( ! this.checkAction( 'myAction' ) )
            {   return; }

            this.ajaxcall( "/sixtyone/sixtyone/myAction.html", { 
                                                                    lock: true, 
                                                                    myArgument1: arg1, 
                                                                    myArgument2: arg2,
                                                                    ...
                                                                 }, 
                         this, function( result ) {
                            
                            // What to do after the server call if it succeeded
                            // (most of the time: nothing)
                            
                         }, function( is_error) {

                            // What to do after the server call in anyway (success or failure)
                            // (most of the time: nothing)

                         } );        
        },        
        
        */

        
        ///////////////////////////////////////////////////
        //// Reaction to cometD notifications

        /*
            setupNotifications:
            
            In this method, you associate each of your game notifications with your local method to handle it.
            
            Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                  your sixtyone.game.php file.
        
        */
        setupNotifications: function()
        {
            console.log( 'notifications subscriptions setup' );
            
            // TODO: here, associate your game notifications with local methods
            
            // Example 1: standard notification handling
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            
            // Example 2: standard notification handling + tell the user interface to wait
            //            during 3 seconds after calling the method in order to let the players
            //            see what is happening in the game.
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
            // 
        },  
        
        // TODO: from this point and below, you can write your game notifications handling methods
        
        /*
        Example:
        
        notif_cardPlayed: function( notif )
        {
            console.log( 'notif_cardPlayed' );
            console.log( notif );
            
            // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
            
            // TODO: play the card in the user interface.
        },    
        
        */
   });             
});
