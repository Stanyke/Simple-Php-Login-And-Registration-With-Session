<?php
$dbHost		= 	'localhost';
$dbUsername = 	'root';
$dbPassword = 	'';
$dbName     =	'php_with_session';

$db 		=	new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
if($db->connect_error)
{
    die("Sorry, We Encountered An Error And Will Fixed In No Time.\n Thanks: " . $db->connect_error);
}

?>