<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/request.php
******************************************************************************/

//! Static utility to analyze the request
/*!
	Essentially provides a wrapper for $_GET, $_POST, and $_FILES globals.
	Also used to grab the action segment of the URL (JURL).
*/
class JRequest {

	//! Grab a $_GET variable
	/*!
		Although you can certainly use the global $_GET variable directly, this
		method makes sure the variable even exists.
		@param $key The array key for the $_GET variable
		@param $default If the $_GET variable does not exist, return $default
		@return string or $default
	*/
	public static function GET( $key, $default = false ) {
		if( !isset( $_GET[$key] ) ) return $default;
		return $_GET[$key];
	}

	//! Grab a $_POST variable
	/*!
		Although you can certainly use the global $_POST variable directly, this
		method makes sure the variable even exists.
		@param $key The array key for the $_POST variable
		@param $default If the $_POST variable does not exist, return $default
		@return string or $default
	*/
	public static function POST( $key, $default = false ) {
		if( !isset( $_POST[$key] ) ) return $default;
		return $_POST[$key];
	}

	//! Grab a $_FILES variable
	/*!
		Although you can certainly use the global $_FILES variable directly, this
		method makes sure the variable even exists.
		@param $key The array key for the $_FILES variable
		@param $default If the $_FILES variable does not exist, return $default
		@return string or $default
	*/
	public static function FILES( $key, $default = null ) {
		if( !isset( $_FILES[$key] ) || empty( $_FILES[$key]['name'] ) ) return $default;
		return $_FILES[$key];
	}

	//! Grab an action segment by index @sa JURL::getAction()
	public static function ACTION( $index, $default = null ) {
		return JURL::getAction( $index, $default );
	}

	//! Check all global request variables for a particular key
	/*!
		1. Check FILES()
		2. Check POST()
		3. Check GET()
		4. Check URL::hasAction()
		@param $key The array key or action string
		@param $default If the variable cannot be found then return $default
		@return string or $default
	*/
	public static function ANY( $key, $default = null ) {
		if( self::FILES( $key, false ) !== false ) return self::FILES( $key );
		else if( self::POST( $key, false ) !== false ) return self::POST( $key );
		else if( self::GET( $key, false ) !== false ) return self::GET( $key );
		else if( JURL::hasAction( $key ) ) return true;
		else return $default;
	}

}

?>
