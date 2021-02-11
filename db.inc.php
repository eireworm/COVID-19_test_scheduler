<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$database = 'pcrtestscheduler';

$con = mysqli_connect( $dbhost, $dbusername, $dbpassword, $database );

if(!$con) {
    die( 'Failed to connect to MySQL: ' . mysqli_connect_error() );
}
?>