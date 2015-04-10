<?php
/******************************************************************************
* JAW DEVELOPMENT LLC
* jframe
* github.com/jawdev/jframe
* /lib/jrouter.php
******************************************************************************/

//! Utilizes URL to load a particular page or asset
class JRouter {

	private static $init_complete = false;

	public static function init() {
		if( self::$init_complete ) return false;
		self::route();
		self::$init_complete = true;
		return true;
	}

	private static function route() {
		$segs = JURL::getSegments();
		if( count( $segs ) == 0 || empty( $segs[0] ) ) {
			include( JFRAME_PATH_LOCAL_PAGES.JFRAME_PAGE_DEFAULT.'.php' );
			return;
		}
		$dir = "";
		for( $i = 0; $i < count( $segs ); $i++ ) {
			$s = $segs[$i];
			$d = $dir.$s.'/';
			$f = $dir.$s;
			$ind = $dir.JFRAME_PAGE_DEFAULT;
			if( is_dir( JFRAME_PATH_LOCAL_PAGES.$d ) ) {
				$dir = $d;
				continue;
			} else if( file_exists( JFRAME_PATH_LOCAL_PAGES.$f.'.php' ) ) {
				JURL::sliceActions( $i+1 );
				JPage::loadPage( $f );
				return;
			} else if( file_exists( JFRAME_PATH_LOCAL_PAGES.$ind.'.php' ) ) {
				JURL::sliceActions( $i );
				JPage::loadPage( $ind );
				return;
			} else {
				JPage::loadPage( JFRAME_PAGE_ERROR );
				return;
			}
		}
	}

}

?>
