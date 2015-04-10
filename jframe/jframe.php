<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /jframe.php
******************************************************************************/

//=====================================
// check settings
//=====================================

if( !isset( $JFRAME_SETTINGS ) ) die( '<pre>[JFrame:FATAL] $JFRAME_SETTINGS has not been set</pre>' );

date_default_timezone_set( $JFRAME_SETTINGS['timezone'] );

// ending slashes
foreach( $JFRAME_SETTINGS as $key => $val ) {
	if( strpos( $key, "path" ) !== 0 ) continue;
	else if( strlen( $val ) == 0 ) continue;
	else if( $val[strlen( $val )-1] == '/' ) continue;
	$JFRAME_SETTINGS[$key] = $val.'/';
}

//=====================================
// UTILS
//=====================================

define( 'JFRAME_DEBUG', $JFRAME_SETTINGS['debug'] );
define( 'JFRAME_QS_URL', 'JFRAME_URL' );

//=====================================
// PATHS
//=====================================

define( 'JFRAME_PATH', dirname( __FILE__ ).'/' );
define( 'JFRAME_PATH_LIB', JFRAME_PATH.'lib/' );
define( 'JFRAME_PATH_JS', JFRAME_PATH.'js/' );

define( 'JFRAME_PATH_LOCAL', $JFRAME_SETTINGS['path'] );
define( 'JFRAME_PATH_LOCAL_LIB', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-lib'] );
define( 'JFRAME_PATH_LOCAL_HEADERS', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-headers'] );
define( 'JFRAME_PATH_LOCAL_PAGES', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-pages'] );
define( 'JFRAME_PATH_LOCAL_PARTIALS', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-partials'] );
define( 'JFRAME_PATH_LOCAL_FOOTERS', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-footers'] );
define( 'JFRAME_PATH_LOCAL_CSS', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-css'] );
define( 'JFRAME_PATH_LOCAL_IMG', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-img'] );
define( 'JFRAME_PATH_LOCAL_JS', JFRAME_PATH_LOCAL.$JFRAME_SETTINGS['path-js'] );

define( 'JFRAME_PATH_LOCAL_URL', $JFRAME_SETTINGS['path-url'] );
define( 'JFRAME_PATH_LOCAL_URL_SUB', $JFRAME_SETTINGS['path-url-sub'] );
define( 'JFRAME_PATH_LOCAL_URL_CSS', $JFRAME_SETTINGS['path-url-css'] );
define( 'JFRAME_PATH_LOCAL_URL_IMG', $JFRAME_SETTINGS['path-url-img'] );
define( 'JFRAME_PATH_LOCAL_URL_JS', $JFRAME_SETTINGS['path-url-js'] );

define( 'JFRAME_PAGE_DEFAULT', $JFRAME_SETTINGS['page-default'] );
define( 'JFRAME_PAGE_ERROR', $JFRAME_SETTINGS['page-error'] );

//=====================================
// AUTOLOADER
//=====================================

function JFRAME_autoload_class( $classname ) {
	$f1 = strtolower( $classname ).'.php';
	$f2 = str_replace( '_', '/', $f1 );
	$use_f2 = ( $f2 != $f1 );
	$paths = [ JFRAME_PATH_LOCAL_LIB.$f1 ];
	if( $use_f2 ) $paths[] = JFRAME_PATH_LOCAL_LIB.$f2;
	$paths[] = JFRAME_PATH_LIB.$f1;
	if( $use_f2 ) $paths[] = JFRAME_PATH_LIB.$f2;
	foreach( $paths as $p ) if( file_exists( $p ) ) return require_once( $p );
	$msg = "[JFrame:FATAL] Class could not be found: $classname\n";
	for( $i = 0; $i < count( $paths ); $i++ ) $msg .= $paths[$i]."\n";
	echo "<pre>$msg</pre>";
	ob_start();
	debug_print_backtrace();
	$bt = ob_get_clean();
	die( "<pre>$bt</pre>" );
	return false;
}
spl_autoload_register( "JFRAME_autoload_class", false );


//=====================================
// INIT
//=====================================

JURL::init();
JRouter::init();
JPage::output();
JDebug::output();

?>
