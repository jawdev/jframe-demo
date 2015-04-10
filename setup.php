<?php

$JFRAME_SETTINGS = [

	'mysql-host'	=> 'localhost',
	'mysql-user'	=> 'jframedemo',
	'mysql-pass'	=> 'jframedemo',
	'mysql-db'		=> 'jframedemo',

	'path'			=> dirname( __FILE__ ).'/',
	'path-css'		=> 'public/assets/css/',
	'path-img'		=> 'public/assets/img/',
	'path-js'		=> 'public/assets/js/',

	'path-url'		=> 'http://localhost/',
	'path-url-sub'	=> 'jframe/',
	'path-url-css'	=> 'assets/css/',
	'path-url-img'	=> 'assets/img/',
	'path-url-js'	=> 'assets/js/',

	'path-lib'		=> 'script/lib/',
	'path-headers'	=> 'script/headers/',
	'path-pages'	=> 'script/pages/',
	'path-partials'	=> 'script/partials/',
	'path-footers'	=> 'script/footers/',

	'page-default'	=> 'index',
	'page-error'	=> 'error',

	'timezone'		=> 'America/Denver',
	'debug'			=> true,

];

require_once( "jframe/jframe.php" );

?>
