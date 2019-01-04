<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
    $id = trim($_REQUEST["id_eliminar"]);
    $fecha = trim($_REQUEST["fecha"]);

    //$sql = "UPDATE cliente set estado=0 where id_cliente={$id}";
    $sql = "DELETE FROM compra_r WHERE id_compra={$id}";

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo $fecha;
?>