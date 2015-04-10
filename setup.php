<?php

$JFRAME_SETTINGS = [

	'mysql-host'	=> 'localhos',
	'mysql-user'	=> 'test',
	'mysql-pass'	=> 'test',
	'mysql-db'		=> 'test',

	'path'			=> dirname( __FILE__ ).'/',
	'path-css'		=> 'public/assets/css/',
	'path-img'		=> 'public/assets/img/',
	'path-js'		=> 'public/assets/js/',

	'path-url'		=> 'jframe/',
	'path-url-css'	=> 'assets/css/',
	'path-url-img'	=> 'assets/img/',
	'path-url-js'	=> 'assets/js/',

	'path-lib'		=> 'script/lib/',
	'path-headers'	=> 'script/headers/',
	'path-pages'	=> 'script/pages/',
	'path-footers'	=> 'script/footers/',

	'timezone'		=> 'America/Denver',

];

require_once( "jframe/jframe.php" );

?>
