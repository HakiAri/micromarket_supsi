<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$nombre = trim($_POST["nombre"]);
	$lim1=trim($_POST["limite1"]);
	$lim2=trim($_POST["limite2"]);
	$lim3=trim($_POST["limite3"]);

	
	//$valorTicket =$lim1.$lim2.$lim3;
	$valorTicket =$lim1." ".$lim2." ".$lim3;
	$fechaRegistro = date('Y-m-d H:i:s');



	$sql = "INSERT INTO seccion(nombre,valor_ticket, fecha_registro) VALUES('{$nombre}', '{$valorTicket}','{$fechaRegistro}')";

	if (!$con->query($sql)) {
		echo "Falló la insercion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
?>