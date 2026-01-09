<?php

function conndata(){
    
   $host = "localhost";
    $username = "buyjee_testbuyjee";
    $password = 'Bkx$=w0$k^X^';
    $dbname = "buyjee_testingecomersdb";
    
    $conn = new mysqli($host,$username,$password,$dbname);

 if ($conn->connect_error) {
    }
   
    return $conn;
}
?>