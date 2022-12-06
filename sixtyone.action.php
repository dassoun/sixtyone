<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SixtyOne implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 * 
 * sixtyone.action.php
 *
 * SixtyOne main action entry point
 *
 *
 * In this file, you are describing all the methods that can be called from your
 * user interface logic (javascript).
 *       
 * If you define a method "myAction" here, then you can call it from your javascript code with:
 * this.ajaxcall( "/sixtyone/sixtyone/myAction.html", ...)
 *
 */
  
  
  class action_sixtyone extends APP_GameAction
  { 
    // Constructor: please do not modify
   	public function __default()
  	{
  	    if( self::isArg( 'notifwindow') )
  	    {
            $this->view = "common_notifwindow";
  	        $this->viewArgs['table'] = self::getArg( "table", AT_posint, true );
  	    }
  	    else
  	    {
            $this->view = "sixtyone_sixtyone";
            self::trace( "Complete reinitialization of board game" );
      }
  	} 
  	
  	// TODO: defines your action entry points there


    /*
    
    Example:
  	
    public function myAction()
    {
        self::setAjaxMode();     

        // Retrieve arguments
        // Note: these arguments correspond to what has been sent through the javascript "ajaxcall" method
        $arg1 = self::getArg( "myArgument1", AT_posint, true );
        $arg2 = self::getArg( "myArgument2", AT_posint, true );

        // Then, call the appropriate method in your game logic, like "playCard" or "myAction"
        $this->game->myAction( $arg1, $arg2 );

        self::ajaxResponse( );
    }
    
    */

    public function chooseArea()
    {
        self::setAjaxMode();     

        // Retrieve arguments
        // Note: these arguments correspond to what has been sent through the javascript "ajaxcall" method
        $area_id = self::getArg( "area_id", AT_posint, true );
        
        // Then, call the appropriate method in your game logic, like "playCard" or "myAction"
        $this->game->chooseArea( $area_id );

        self::ajaxResponse( );
    }

    public function chooseDie()
    {
        self::setAjaxMode();     

        // Retrieve arguments
        // Note: these arguments correspond to what has been sent through the javascript "ajaxcall" method
        $die_id = self::getArg( "die_id", AT_posint, true );
        
        // Then, call the appropriate method in your game logic, like "playCard" or "myAction"
        $this->game->chooseDie( $die_id );

        self::ajaxResponse( );
    }

    public function chooseDieLocation()
    {
        self::setAjaxMode();     

        // Retrieve arguments
        // Note: these arguments correspond to what has been sent through the javascript "ajaxcall" method
        $area_id = self::getArg( "area_id", AT_posint, true );
        $location_id = self::getArg( "location_id", AT_posint, true );
        
        // Then, call the appropriate method in your game logic, like "playCard" or "myAction"
        $this->game->chooseDieLocation( $area_id, $location_id );

        self::ajaxResponse( );
    }

  }
  

