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
            
            this.connections = [];

            // Constants
            this.gameConstants = gamedatas.constants;

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
                // players name
                $('sxt_player_name_'+player_id).innerHTML = gamedatas.players[player_id].name
                dojo.style( 'sxt_player_name_'+player_id, 'color', '#'+gamedatas.players[player_id].color );

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

                // Scores
                for (let i = 0; i < score_coords.length; i++){
                    dojo.place( this.format_block('jstpl_sxt_score', {
                        player_id: player_id,
                        id: (i+1),
                    } ), $ ( 'sxt_player_board_'+player_id ) );

                    this.slideToObjectPos( 'sxt_score_'+player_id+'_'+(i+1), 'sxt_player_board_'+player_id, score_coords[i][0], score_coords[i][1] ).play();
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
            
            // Areas
            let areas = ['1', '2', '3', '4', '5', '6'];

            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Show some HTML block at this game state
                dojo.style( 'my_html_block_id', 'display', 'block' );
                
                break;
           */

            ////////////////////////////////////////////////////
            case 'multiplayerPhase':
                dice = args.args;
                console.log(dice);
                for (i=1; i<4; i++) {
                    dojo.addClass('sxt_die_'+i, 'sxt_die_'+dice[i]);
                }
                break;

            ////////////////////////////////////////////////////
            case 'chooseArea':
                dice = args.args;
                console.log(dice);

                console.log('spectator : '+this.isSpectator);
                console.log(dice);

                for (let i=1; i<=6; i++) {
                    dojo.place( this.format_block('jstpl_sxt_area', {
                        player_id: this.player_id,
                        area_id: i,
                    } ), $ ( 'sxt_player_board_'+this.player_id ) );

                    this.slideToObjectPos( 'sxt_area_'+this.player_id+'_'+i, 'sxt_player_board_'+this.player_id, area_coords[i-1][0], area_coords[i-1][1] ).play();
                }
                
                for (const [key, value] of Object.entries(dice)) {

                    let index = areas.indexOf(value);
                    console.log(areas + ', ' + value + ', ' + index);
                    if (index > -1) { // only splice array when item is found
                        
                        areas.splice(index, 1); // 2nd parameter means remove one item only
                    }

                    let elmt = 'sxt_area_'+this.player_id+'_'+value;

                    dojo.addClass(elmt, 'sxt_area_clickable');

                    this.connections.push( dojo.connect( $(elmt) , 'click', () => this.onClickArea(elmt) ) );
                }

                for (let i=0; i<areas.length; i++) {
                    dojo.addClass('sxt_area_'+this.player_id+'_'+areas[i], 'sxt_area_unclickable');
                }
                break;

            ////////////////////////////////////////////////////
            case 'chooseDie':
                die_info = args.args;
                console.log(die_info);

                for (let i=1; i<=3; i++) {
                    if (i != die_info['die_id']) {
                        let elmt = 'sxt_die_'+i;

                        dojo.addClass(elmt, 'sxt_die_clickable');

                        this.connections.push( dojo.connect( $(elmt) , 'click', () => this.onClickDie(elmt) ) );
                    } else {
                        dojo.addClass('sxt_die_'+i, 'sxt_die_used');
                    }
                }

                let index = areas.indexOf(die_info['die_value']);
                if (index > -1) { // only splice array when item is found
                    areas.splice(index, 1); // 2nd parameter means remove one item only
                }

                for (let i=0; i<areas.length; i++) {
                    dojo.place( this.format_block('jstpl_sxt_area', {
                        player_id: this.player_id,
                        area_id: (areas[i]),
                    } ), $ ( 'sxt_player_board_'+this.player_id ) );

                    this.slideToObjectPos( 'sxt_area_'+this.player_id+'_'+areas[i], 'sxt_player_board_'+this.player_id, area_coords[areas[i]-1][0], area_coords[areas[i]-1][1] ).play();

                    dojo.addClass('sxt_area_'+this.player_id+'_'+areas[i], 'sxt_area_unclickable');
                }

                console.log("unavailable_dice_id : " + die_info['die_id']);
                break;

            case 'chooseDieLocation':
                location_info = args.args;
                console.log(location_info);

                let area_id = args.args['area_id'];
                let locations = args.args['locations'];

                let player_id = this.player_id;

                console.log('locations : '+locations);

                for (let i=0; i<locations.length; i++) {
                    // console.log('sxt_location_'+player_id+'_'+area_id+'_'+locations[i]);
                    let elmt = 'sxt_location_'+player_id+'_'+area_id+'_'+locations[i];
                    
                    dojo.addClass(elmt, 'sxt_location_clickable');

                    this.connections.push( dojo.connect( $(elmt) , 'click', () => this.onClickLocation(elmt) ) );
                }

                break;

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
                case 'chooseArea':
                    if (!this.isSpectator) {
                        for (i=1; i<7; i++) {
                            dojo.destroy('sxt_area_'+this.player_id+'_'+i);
                        }
                    }

                    dojo.forEach(this.connections, dojo.disconnect);
                    this.connections = []; 

                    break;

                case 'chooseDie':
                    dojo.forEach(this.connections, dojo.disconnect);
                    this.connections = []; 
                    break;
           
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

        onClickArea: function( elmt )
        {
            console.log( '$$$$ Event : onClickArea' );

            if( ! this.checkAction( 'chooseArea' ) )
            { return; }

            console.log(elmt);
            let area_id = elmt.split('_')[3];
            console.log(area_id);
            
            // console.log( '$$$$ Selected dice : (' + dice_id + ')' );
            
            if ( this.isCurrentPlayerActive() ) {
                // for (let dice of dices) {
                //     if (dice.player_id == null) {
                //         dojo.removeClass( 'dice_'+dice.id+'_'+dice.dice_value, 'ctc_dice_clickable' );
                //     }
                // }
                this.ajaxcall( "/sixtyone/sixtyone/chooseArea.html", { lock: true, area_id: area_id }, this, function( result ) {}, function( is_error ) {} );
            }
        },

        onClickDie: function( elmt )
        {
            console.log( '$$$$ Event : onClickDie' );

            if( ! this.checkAction( 'chooseDie' ) )
            { return; }

            console.log(elmt);

            let die_id = elmt.split('_')[2];
            console.log(die_id);
            
            // console.log( '$$$$ Selected dice : (' + dice_id + ')' );
            
            if ( this.isCurrentPlayerActive() ) {
                // for (let dice of dices) {
                //     if (dice.player_id == null) {
                //         dojo.removeClass( 'dice_'+dice.id+'_'+dice.dice_value, 'ctc_dice_clickable' );
                //     }
                // }
                this.ajaxcall( "/sixtyone/sixtyone/chooseDie.html", { lock: true, die_id: die_id }, this, function( result ) {}, function( is_error ) {} );
            }
        },

        onClickLocation: function( elmt ) 
        {
            console.log( '$$$$ Event : onClickLocation' );

            if( ! this.checkAction( 'chooseDieLocation' ) )
            { return; }

            console.log(elmt);

            let area_id = elmt.split('_')[3];
            let location_id = elmt.split('_')[4];

            console.log(area_id);

            if ( this.isCurrentPlayerActive() ) {
                // for (let dice of dices) {
                //     if (dice.player_id == null) {
                //         dojo.removeClass( 'dice_'+dice.id+'_'+dice.dice_value, 'ctc_dice_clickable' );
                //     }
                // }
                this.ajaxcall( "/sixtyone/sixtyone/chooseDieLocation.html", { lock: true, area_id: area_id, location_id: location_id }, this, function( result ) {}, function( is_error ) {} );
            }
        },

        
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

            dojo.subscribe( 'locationChosen', this, "notif_locationChosen" );
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

        notif_locationChosen: function( notif )
        {
            console.log( notif );

            let player_id = this.player_id;

            let area_id = notif.args.area_id;
            let location_id = notif.args.location_id;
            let die_value = notif.args.die_value;

            dojo.byId('sxt_location_'+player_id+'_'+area_id+'_'+location_id).innerHTML = die_value;
        },
   });             
});
