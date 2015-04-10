<?php

$JFRAME_SETTINGS = [

	'mysql-host'	=> '__MYSQL_HOST__',
	'mysql-user'	=> '__MYSQL_USER__',
	'mysql-pass'	=> '__MYSQL_PASS__',
	'mysql-db'		=> '__MYSQL_DB__',

	'path'			=> dirname( __FILE__ ).'/',
	'path-css'		=> 'public/assets/css/',
	'path-img'		=> 'public/assets/img/',
	'path-js'		=> 'public/assets/js/',

	'path-url'		=> '__PATH_URL__',
	'path-url-sub'	=> '__PATH_URL_SUB__',
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

	'timezone'		=> '__TIMEZONE__',
	'debug'			=> true,

];

require_once( "jframe/jframe.php" );

?>
