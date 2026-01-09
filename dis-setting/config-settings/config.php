<?php
 session_start();
date_default_timezone_set('Asia/Kolkata');
// site connection

function contdatabase(){
    
    $host = "localhost";
    $username = "buyjee_testbuyjee";
    $password = 'Bkx$=w0$k^X^';
    $dbname = "buyjee_testingecomersdb";
    
    $conntdb = new mysqli($host,$username,$password,$dbname);
   if ($conntdb->connect_error) {
   // die("Connection failed: " . $conntdb->connect_error);
}
    return $conntdb;
}

$contdb = contdatabase();
?>