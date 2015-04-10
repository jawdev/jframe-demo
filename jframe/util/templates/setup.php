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
	'path-url-css'	=> 'assets/css/',
	'path-url-img'	=> 'assets/img/',
	'path-url-js'	=> 'assets/js/',

	'path-lib'		=> 'script/lib/',
	'path-headers'	=> 'script/headers/',
	'path-pages'	=> 'script/pages/',
	'path-footers'	=> 'script/footers/',

	'timezone'		=> '__TIMEZONE__',

];

require_once( "jframe/jframe.php" );

?>
