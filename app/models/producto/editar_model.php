<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$nroPlu=trim($_REQUEST["plu"]);
	$id = trim($_REQUEST["id_producto"]);
	$nombre = trim($_POST["nombre"]);
	$precio = trim($_POST["precio"]);
	$tipo = trim($_POST["tipoVenta"]);
	$codPlu=($tipo*1000)+$nroPlu;
	$idSeccion=$_REQUEST['seccion'];

	$sql = "UPDATE producto set nombre='{$nombre}', precio={$precio}, tipo={$tipo}, cod_plu={$codPlu}, idSeccion={$idSeccion} where id_prod={$id}";

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
?>