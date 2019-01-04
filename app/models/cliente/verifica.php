<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	$cliente=$_REQUEST['ci'];
	if(isset($_REQUEST['tipo'])){

		$sql="SELECT * FROM cliente WHERE ci = '{$cliente}' and id_cliente != {$_REQUEST['id']}";
		if($resultado=$con->query($sql)){
			$nrodefilas=$resultado->num_rows;
			if($nrodefilas == 0)
				echo "true";
			else
				echo "false";
		}
	}else{
		$sql="SELECT * FROM cliente WHERE ci = '{$cliente}'";
		if($resultado=$con->query($sql)){
			$nrodefilas=$resultado->num_rows;
			if($nrodefilas == 0)
				echo "true";
			else
				echo "false";
		}
	}
?>