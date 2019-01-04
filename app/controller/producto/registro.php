<?php
	require_once '../../config/route.php';
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ".ROOT_CONTROLLER.'login/');
		exit;
	}
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$sql="SELECT IFNULL(MAX(nro_plu),0)+1  AS numero FROM producto";
	if (!($resultado = $con->query($sql))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$fila = $resultado->fetch_row();
	$sql="SELECT * FROM SECCION where estado = 1 ";
	if (!($secciones = $con->query($sql))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$titulo="Nuevo Producto";
	$contenido="producto/registro.php";
	$menu_a= $menus['P_REGISTRO'];
	$subTitulo="Producto o PLU";
	//$pie_class="si";
	require_once ('../../../public/views/plantilla.php');
?>