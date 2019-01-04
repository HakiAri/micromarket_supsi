<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php"); 
	
	$ci=$_REQUEST['id'];
	$sql = $con->query("SELECT * FROM cliente WHERE ci='{$ci}'");
	$contar =$sql->num_rows;
    if($contar == 0){
        $datos['estado']= "No";
    }else{
    	$datos['estado']= "si";
    	foreach ($sql as $row ) {
		    $datos['cliente'] = $row;		            
		}
	}
	echo json_encode($datos);
?>