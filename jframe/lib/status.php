<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/status.php
******************************************************************************/

//! Struct to hold data for JStatus
class JStatusEl {
	public $code;		//!< JStatus code constant
	public $message;	//!< JStatus message string
	//! Load $code and $message variables
	function __construct( $code, $message ) {
		$this->code = $code;
		$this->message = $message;
	}
}

//! Used to hold status messages
/*!
	JStatus is used all over the framework, and is very useful when a more
	comprehensive return value is needed by a function. Often just true/false is
	not enough. With this class you can push a status, then subsequently poll
	the last status message.
	@warning The JStatus::NONE constant returns true
*/
class JStatus {

	const INCOMPLETE	= -3;	//!< There is missing data or the process could not finish
	const FAIL			= -2;	//!< The process failed
	const ERROR			= -1;	//!< There was an error while processing (most common)
	const NONE			= 0;	//!< No status
	const OK			= 1;	//!< Bland form of JStatus::SUCCESS
	const SUCCESS		= 2;	//!< Every processed successfully

	public static $elements = [];	//!< Array stack of JStatusEl

	//====================================
	// PUSH
	//====================================

	//! Push a JStatusEl onto the stack
	/*!
		@param $code The JStatus code constant
		@param $message The message
		@return $boolean( $code >= 0 )
	*/
	public static function push( $code, $message = "" ) {
		self::$elements[] = new JStatusEl( $code, $message );
		return ( $code >= 0 );
	}

	//! push() a JStatus::INCOMPLETE message @return false
	public static function incomplete( $message = "" ) {
		return self::push( self::INCOMPLETE, $message );
	}

	//! push() a JStatus::FAIL message @return false
	public static function fail( $message = "" ) {
		return self::push( self::FAIL, $message );
	}

	//! push() a JStatus::ERROR message @return false
	public static function error( $message = "" ) {
		return self::push( self::ERROR, $message );
	}

	//! push() a JStatus::NONE message @return true
	public static function none( $message = "" ) {
		return self::push( self::NONE, $message );
	}

	//! push() a JStatus::OK message @return true
	public static function ok( $message = "" ) {
		return self::push( self::OK, $message );
	}

	//! push() a JStatus::SUCCESS message @return true
	public static function success( $message = "" ) {
		return self::push( self::SUCCESS, $message );
	}

	//====================================
	// GET
	//====================================

	//! Get a JStatusEl from the stack
	/*!
		@param $index The index of the JStatusEl in the stack, if not set, get the
			latest element
		@return JStatusEl
	*/
	public static function get( $index = false ) {
		if( count( self::$elements ) == 0 ) return null;
		else if( $index === false ) return end( self::$elements );
		else return self::$elements[$index];
	}

	//! Get a message from the stack
	/*!
		@param $index The index of the JStatusEl in the stack, if not set, use the
			latest element
		@return string
	*/
	public static function message( $index = false ) {
		if( count( self::$elements ) == 0 ) return "";
		else if( $index === false ) return end( self::$elements )->message;
		else return self::$elements[$index]->message;
	}

	//! Get a code from the stack
	/*!
		@param $index The index of the JStatusEl in the stack, if not set, use the
			latest element
		@return int
	*/
	public static function code( $index = false ) {
		if( count( self::$elements ) == 0 ) return self::NONE;
		else if( $index === false ) return end( self::$elements )->code;
		else return self::$elements[$index]->code;
	}

	//! Check if a status code is >= 0
	/*!
		@param $index The index of the JStatusEl in the stack, if not set, use the
			latest element
		@return boolean( code >= 0 )
	*/
	public static function good( $index = false ) {
		return ( self::code( $index ) >= 0 );
	}

	//! Check if a status code is < 0
	/*!
		@param $index The index of the JStatusEl in the stack, if not set, use the
			latest element
		@return boolean( code < 0 )
	*/
	public static function bad( $index = false ) {
		return ( self::code( $index ) < 0 );
	}

}
