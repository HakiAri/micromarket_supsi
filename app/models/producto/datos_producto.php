<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$id=$_REQUEST['id_producto'];
	$sql="SELECT * FROM producto WHERE id_prod={$id}";
	if($result = $con->query($sql)){
		if($result->num_rows > 0){
			$jsondata['estado']="correcto";
			while ($row = $result->fetch_array() ) {
				$jsondata['producto'] = $row;
			}
		}
	}else{
		$jsondata['estado']="Error en la consulta";
	}
	echo json_encode($jsondata);
?>