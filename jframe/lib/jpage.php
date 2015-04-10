<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/jpage.php
******************************************************************************/

//! Static interface for the current page output
class JPage {

	private static $js = [];
	private static $css = [];
	private static $headers = [];
	private static $pages = [];
	private static $footers = [];

	//====================================
	// ADD
	//====================================

	//! Add a CSS file
	public static function addCss( $name ) {
		if( isset( self::$css[$name] ) ) return;
		else if( !file_exists( JFRAME_PATH_LOCAL_CSS.$name.'.css' ) ) JDebug::warn( "CSS file could not be found: ".JFRAME_PATH_LOCAL_CSS.$name.'.css' );
		else self::$css[$name] = true;
	}

	//! Add a JS file
	public static function addJs( $name ) {
		if( isset( self::$js[$name] ) ) return;
		$p1 = JFRAME_PATH_LOCAL_JS.$name.'.js';
		if( !file_exists( $p1 ) ) JDebug::warn( "JS file could not be found: $p1" );
		else self::$js[$name] = true;
	}

	//! addCss() and addJs() combined
	public static function addCssJs( $name ) {
		self::addCss( $name );
		self::addJS( $name );
	}

	//! Build CSS links
	/*!
		@param $prefix Place this string at the start of each line
		@return HTML string
	*/
	public static function buildCss( $prefix = "\t" ) {
		$out = "";
		foreach( self::$css as $name => $enabled ) {
			if( $enabled !== true ) continue;
			$out .= $prefix."<link rel='stylesheet' type='text/css' href='".JURL::getBase().JFRAME_PATH_LOCAL_URL_CSS.$name.".css' />\n";
		}
		return $out;
	}

	//! Build JS scripts
	/*!
		@param $prefix Place this string at the start of each line
		@return HTML string
	*/
	public static function buildJs( $prefix = "\t" ) {
		$out = "";
		foreach( self::$js as $name => $enabled ) {
			if( $enabled !== true ) continue;
			$out .= $prefix."<script type='text/javascript' src='".JURL::getBase().JFRAME_PATH_LOCAL_URL_JS.$name.".js'></script>\n";
		}
		return $out;
	}

	//! Concatenate both buildCss() and buildJs()
	public static function buildCssJs( $prefix = "\t" ) {
		return self::buildCss( $prefix ).self::buildJs( $prefix );
	}

	//====================================
	// LOAD
	//====================================

	//! Load a header file
	public static function loadHeader( $header_path = "default" ) {
		if( isset( self::$headers[$header_path] ) ) JDebug::error( "skipping previously loaded header: $header_path" );
		else if( !file_exists( JFRAME_PATH_LOCAL_HEADERS.$header_path.'.php' ) ) JDebug::fatal( "header could not be found: ".JFRAME_PATH_LOCAL_HEADERS.$header_path.'.php' );
		self::$headers[$header_path] = true;
	}

	//! Load a header and footer file
	public static function loadHeaderFooter( $path = "default" ) {
		self::loadHeader( $path );
		self::loadFooter( $path );
	}

	//! Load a page file, called by JRouter::route()
	public static function loadPage( $page_path ) {
		if( isset( self::$pages[$page_path] ) ) JDebug::error( "skipping previously loaded page: $page_path" );
		else if( !file_exists( JFRAME_PATH_LOCAL_PAGES.$page_path.'.php' ) ) JDebug::fatal( "page could not be found: ".JFRAME_PATH_LOCAL_PAGES.$page_path.'.php' );
		self::$pages[$page_path] = true;
	}

	//! Load a footer file
	public static function loadFooter( $footer_path = "default" ) {
		if( isset( self::$footers[$footer_path] ) ) JDebug::error( "skipping previously loaded footer: $footer_path" );
		else if( !file_exists( JFRAME_PATH_LOCAL_FOOTERS.$footer_path.'.php' ) ) JDebug::fatal( "footer could not be found: ".JFRAME_PATH_LOCAL_FOOTERS.$footer_path.'.php' );
		self::$footers[$footer_path] = true;
	}

	//====================================
	// APPEND
	//====================================

	//! Append a page file
	public static function appendPage( $page_path ) {
		if( !file_exists( JFRAME_PATH_LOCAL_PAGES.$page_path.'.php' ) ) JDebug::fatal( "page could not be found: ".JFRAME_PATH_LOCAL_PAGES.$page_path.'.php' );
		return include( JFRAME_PATH_LOCAL_PAGES.$page_path.'.php' );
	}

	//! Append a partial file
	public static function appendPartial( $partial_path ) {
		if( !file_exists( JFRAME_PATH_LOCAL_PARTIALS.$partial_path.'.php' ) ) JDebug::fatal( "partial could not be found: ".JFRAME_PATH_LOCAL_PARTIALS.$partial_path.'.php' );
		return include( JFRAME_PATH_LOCAL_PARTIALS.$page_path.'.php' );
	}

	//====================================
	// OUTPUT
	//====================================

	//! Stream and output all loaded files, called by /jframe.php
	public static function output() {
		ob_start();
		foreach( self::$pages as $page_file => $enabled ) {
			if( $enabled !== true ) continue;
			include( JFRAME_PATH_LOCAL_PAGES.$page_file.'.php' );
		}
		$body = ob_get_clean();
		foreach( self::$headers as $header_file => $enabled ) {
			if( $enabled !== true ) continue;
			include( JFRAME_PATH_LOCAL_HEADERS.$header_file.'.php' );
		}
		echo $body;
		foreach( self::$footers as $footer_file => $enabled ) {
			if( $enabled !== true ) continue;
			include( JFRAME_PATH_LOCAL_FOOTERS.$footer_file.'.php' );
		}
	}

}

?>
