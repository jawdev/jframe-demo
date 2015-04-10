<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/debug.php
******************************************************************************/

//! Struct to hold a JDebug message
class JDebugEl {
	public $type = 0;		//!< JDebug type code
	public $backtrace = [];	//!< Backtrace array
	public $message = "";	//!< Message string
}

//! Aggregate and display debug messages
class JDebug {

	const INFO		= 0;	//!< just information
	const WARN		= 1;	//!< an error without data ramifications
	const ERROR		= 2;	//!< a data error that does not interrupt flow
	const FATAL		= 3;	//!< a data error that interrupts flow

	private static $is_output = false;
	private static $elements = [];

	//! Push a JDebugEl onto the stack
	/*!
		@param $type type constant
		@param $message Message string
		@return JDebugEl
	*/
	public static function push( $type, $message = "" ) {
		$bt = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		for( $bto = 0; $bto < count( $bt ); $bto++ ) if( !isset( $bt[$bto]['class'] ) || $bt[$bto]['class'] != 'Debug' ) break;
		$el = new JDebugEl;
		$el->type = $type;
		if( $type <= self::WARN ) $el->backtrace = array_slice( $bt, $bto, 3 );
		else $el->backtrace = array_slice( $bt, $bto );
		$el->message = ( is_array( $message ) || is_object( $message ) ? JFormat::pre( $message ) : $message );
		self::$elements[] = $el;
		return $el;
	}

	//! push() a JDebug::INFO message @return JDebugEl
	public static function info( $message = "" ) {
		return self::push( self::INFO, $message );
	}

	//! push() a JDebug::WARN message @return JDebugEl
	public static function warn( $message = "" ) {
		return self::push( self::WARN, $message );
	}

	//! push() a JDebug::ERROR message @return JDebugEl
	public static function error( $message = "" ) {
		return self::push( self::ERROR, $message );
	}

	//! push() a JDebug::FATAL message and terminate the script
	public static function fatal( $message = "" ) {
		self::push( self::FATAL, $message );
		self::output();
		exit( 1 );
	}

	//! Get the type constant as a string @return string
	public static function typeToStr( $t ) {
		switch( $t ) {
			case self::INFO: return "INFO";
			case self::WARN: return "WARN";
			case self::ERROR: return "ERROR";
			case self::FATAL: return "FATAL";
			default: return "UNKNOWN";
		}
	}

	//! Get a color based on the type constant @return string
	public static function typeToColor( $t ) {
		switch( $t ) { 
			case self::INFO: return "#bbf";
			case self::WARN: return "#fb8";
			case self::ERROR: return "#fbb";
			case self::FATAL: return "#f55";
			default: return "#bbb";
		}
	}

	//! Generate the debug messages @return HTML string
	public static function output() {
		if( !JFRAME_DEBUG || self::$is_output || count( self::$elements ) == 0 ) return;
		$out = "<br /><hr />";
		foreach( self::$elements as $m ) {
			$str = self::typeToStr( $m->type );
			$col = self::typeToColor( $m->type );
			$out .= "<pre style='background: $col;'>";
			$out .= "<b>[JFrame:$str]</b> {$m->message}";
			$out .= "<pre>";
			foreach( $m->backtrace as $t ) {
				$out .= "\n";
				foreach( $t as $key => $val ) {
					$out .= "$key\t";
					if( strlen( $key ) < 8 ) $out .= "\t";
					$out .= "= ";
					if( $key == "file" ) $out .= $val;
					else if( is_array( $val ) ) $out .= json_encode( $val );
					else $out .= $val;
					$out .= "\n";
				}
			}
			$out .= "</pre></pre>";
		}
		echo $out;
		self::$is_output = true;
	}

}

?>
