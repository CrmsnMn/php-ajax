<?php 

//DB credentials
$db_name = 'deletethis';
$db_user = 'delete';
$db_password = 'delete';

//connect to DB
$db = new mysqli( 'localhost', $db_user, $db_password, $db_name );

//handle any errors
if( $db->connect_errno > 0 ){
	//stop the page from loading and show a message instead
	die( 'Unable to connect to Database' );
}
error_reporting(E_ALL ^ E_NOTICE);
