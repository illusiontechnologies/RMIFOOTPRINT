<?php

define("CENTRIUM_LINKED_SERVER", "176.34.250.195");

$serverName = "ILLUSION2"; //serverName\instanceName
$connectionInfo = array( "Database"=>"Serenity_dev1", "UID"=>"serenity_dev", "PWD"=>"aHZw46MjapFLpeJr1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    // echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>

