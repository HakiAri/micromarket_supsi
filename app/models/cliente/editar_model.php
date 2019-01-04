<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$id = trim($_REQUEST["id"]);
	$nombre = trim($_POST["name"]);
	$ci = trim($_POST["ci"]);

	$sql = "UPDATE cliente set nombre='{$nombre}', ci='{$ci}' where id_cliente={$id}";

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
?>