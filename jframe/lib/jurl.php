<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/url.php
******************************************************************************/

//! Static utility to parse and build URLs
/*!
	
*/
class JURL {
	
	private static $init_complete = false;
	private static $url_str = "";
	private static $segments = [];
	private static $action_index = false;
	private static $actions = [];

	//! Load the URL segments, called in /jframe.php
	public static function init() {
		if( self::$init_complete ) return false;
		if( isset( $_GET[JFRAME_QS_URL] ) ) {
			self::$url_str = $_GET[JFRAME_QS_URL];
			unset( $_GET[JFRAME_QS_URL] );
		}
		self::$segments = explode( '/', self::$url_str );
		self::$init_complete = true;
		return true;
	}

	//! Get the base prefix of the current project URL @return string
	public static function getBase() {
		return '/'.JFRAME_PATH_LOCAL_URL_SUB;
	}

	//! Get all of the URL segments @return array( string ) @sa getSegment()
	public static function getSegments() {
		return self::$segments;
	}

	//! Get a particular URL segment
	/*!
		@param $index The index of the segment
		@param $default If the segment does not exist, return $default
		@return string or $default
		@sa getSegments()
	*/
	public static function getSegment( $index, $default = false ) {
		if( !isset( self::$segments[$index] ) || empty( self::$segments[$index] ) ) return $default;
		return self::$segments[$index];
	}

	//! Called by JRouter to distinguise the core URL segments from the action
	/*!
		@param $index Where to slice the URL segments array
		@return array( string )
	*/
	public static function sliceActions( $index ) {
		self::$action_index = $index;
		self::$actions = array_slice( self::$segments, $index );
		return self::$actions;
	}

	//! Get all of the URL actions @return array( string ) @sa getAction(), hasAction(), JRequest::ACTION()
	public static function getActions() {
		return self::$actions;
	}

	//! Get a particular action string
	/*!
		@param $index The index of the action
		@param $default If the index has not been set, return $default
		@return string or $default
		@sa getActions(), hasAction(), JRequest::ACTION()
	*/
	public static function getAction( $index = 0, $default = false ) {
		if( !isset( self::$actions[$index] ) ) return $default;
		return self::$actions[$index];
	}

	//! Checks to see if an action is present @return boolean @sa getActions(), getAction(), JRequest::ACTION()
	public static function hasAction( $str ) {
		return ( in_array( strtolower( $str ), self::$actions ) );
	}

	//! Redirect to a page within the current project
	/*!
		@param $url The URL to redirect to within the project
	*/
	public static function redir( $url = "" ) {
		if( headers_sent() ) echo "<script>window.open( '".self::getBase()."$url', '_self' );</script>";
		else header( "Location: ".self::getBase().$url );
		exit;
	}

	//! Redirect to a page outside of the current project
	/*!
		@param $url The complete URL to redirect outside the project
	*/
	public static function redirOut( $url ) {
		if( headers_sent() ) echo "<script>window.open( '$url', '_self' );</script>";
		else header( "Location: $url" );
		exit;
	}

}

?>
