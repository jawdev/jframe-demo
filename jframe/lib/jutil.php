<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/jutil.php
******************************************************************************/

//! Utility functions
class JUtil {

	//! Get an object from the backtrace
	/*!
		@param $n The number of steps backwards to traverse
		@return object
	*/
	public static function backtraceObject( $n = 0 ) {
		$t = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT, $n+2 );
		return $t[$n+1]['object'];
	}

	//! Convert bytes to megabytes
	/*!
		@param $bytes The bytes to convert
		@param $dec_format The number of decimals to format to, if not provided, return the raw value
		@return float or string
	*/
	public static function bToMb( $bytes, $dec_format = false ) {
		$val = ( $bytes/1048576 );
		if( $dec_format !== false ) return number_format( $val, $dec_format );
		else return $val;
	}

	//! Get the current git commit hash for a particular file
	/*!
		@param $file_path The full path to a file
		@return string
	*/
	public static function gitHash( $file_path ) {
		$file_path = str_replace( " ", "\\ ", $file_path );
		return exec( "git log --pretty=format:'%h' -n 1 $file_path" );
	}

	//! Check if a bitmask has a particular bit
	/*!
		@warning If $bitmask = 0 or $bitcheck = 0, false is returned
		@param $bitmask The bitmask to check
		@param $bitcheck The bits to compare the bitmask against
		@return boolean
	*/
	public static function hasBit( $bitmask, $bitcheck = 0 ) {
		if( $bitmask === 0 || $bitcheck === 0 ) return false;
		else return ( ( $bitmask&$bitcheck ) === $bitcheck );
	}

}

?>
