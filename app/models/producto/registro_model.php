<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php");
	$nombre = trim($_POST["nombre"]);
	$nroPlu = trim($_POST["nro_plu"]);
	$precio = trim($_POST["precio"]);
	$tipo = trim($_POST["tipoVenta"]);
	$codPlu=($tipo*1000)+$nroPlu;
	$idSeccion=$_REQUEST['seccion'];
	//echo "<pre>";	print_r ($_REQUEST);echo "</pre>";die();
	if(isset($_REQUEST['limite']))
		$limite=$_REQUEST['limite'];
	else
		$limite=-1;
	$sqlProducto="CALL insertarProducto({$nroPlu},'{$nombre}',{$tipo}, {$precio}, '{$codPlu}',{$idSeccion})";
	if (!$con->query($sqlProducto)) {
		echo "Falló la insercion producto: (" . $con->errno . ") " . $con->error;
	}
	else{
		echo 1;
	}

?>