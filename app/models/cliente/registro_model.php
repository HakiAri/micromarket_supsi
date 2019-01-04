<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	$nombre = trim($_POST["nombre"]);
	$ci = trim($_POST["ci"]);
	$fechaRegistro = date('Y-m-d H:i:s');

	$sql = "INSERT INTO cliente(ci,nombre,fecha_registro) VALUES('{$ci}','{$nombre}','{$fechaRegistro}')";

	if (!$con->query($sql)) {
		echo "Falló la insercion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
?>