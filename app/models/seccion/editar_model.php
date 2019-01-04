<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$id = trim($_REQUEST["id_seccion_modificar"]);
	$nombre = trim($_REQUEST["name"]);
	$lim1=trim($_POST["uno"]);
	$lim2=trim($_POST["dos"]);
	$lim3=trim($_POST["tres"]);

	$valorTicket =$lim1." ".$lim2." ".$lim3;

	$sql = "UPDATE seccion set nombre='{$nombre}',valor_ticket='{$valorTicket}' where id_seccion={$id}";

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
?>