<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/jformat.php
******************************************************************************/

//! Some basic string formatting
class JFormat {

	//! Preformat the data
	/*!
		Wraps $var with &lt;pre> and print_r.
		@param $var A string, object, or some other variable
		@return string
	*/
	public static function pre( $var ) {
		return "<pre>".print_r( $var, true )."</pre>";
	}

	//! Build an ordered list from an array
	/*!
		@param $arr A one-dimensional array
		@return string
	*/
	public static function ol( $arr ) {
		return "<ol><li>".implode( "</li><li>", $arr )."</li></ol>";
	}

	//! Build an unordered list from an array
	/*!
		@param $arr A one-dimensional array
		@return string
	*/
	public static function ul( $arr ) {
		return "<ul><li>".implode( "</li><li>", $arr )."</li></ul>";
	}

	//! Check if the string ends in a slash, if not, add it
	/*!
		Useful for URLs
		@param $str the string to check
		@return string
	*/
	public static function endSlash( $str ) {
		if( $str[strlen( $str )-1] != '/' ) return $str.'/';
		else return $str;
	}

}

?>
