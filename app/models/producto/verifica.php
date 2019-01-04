<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	$nroplu=$_REQUEST['plu'];
	if(isset($_REQUEST['tipo'])){
		$sql="SELECT * FROM producto WHERE nro_plu = '{$nroplu}' and id_prod != {$_REQUEST['idProd']}";
		if($resultado=$con->query($sql)){
			$nrodefilas=$resultado->num_rows;
			if($nrodefilas == 0)
				echo "true";
			else
				echo "false";
		}
	}else{
		$sql="SELECT * FROM producto WHERE nro_plu = '{$nroplu}'";
		if ($resultado=$con->query($sql)) {
			$nrodefilas=$resultado->num_rows;
			if($nrodefilas == 0)
				echo "true";
			else
				echo "false";
		}
	}
?>