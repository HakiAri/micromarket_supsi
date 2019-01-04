<?php 
    require_once 'db.php';
	# conectare la base de datos
    $con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($con->connect_errno){
        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
    }
?>