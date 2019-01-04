<?php
	require_once '../../config/route.php';
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ".ROOT_CONTROLLER.'login/');
		exit;
	}
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	//Variables para enviar a la plantilla
	$titulo="Productos PLU";
	$contenido="producto/index.php";
	$subTitulo="Producto o PLU";
	$menu_a= $menus['P_LISTA'];
	$sql="SELECT p.id_prod,p.nro_plu
			, p.nombre as nomProducto
			, CASE p.tipo WHEN 1 THEN 'Cantidad' WHEN 2 THEN 'Peso' END AS tipo
			, p.precio, p.cod_plu, s.nombre as nomSeccion
		FROM producto p, seccion s
		WHERE p.idseccion = s.id_seccion and p.estado=1";
	if (!($productos = $con->query($sql))) {
    	echo "Falló consulta: (" . $con->errno . ") " . $con->error;
	}
	if (!($secciones = $con->query("SELECT * FROM seccion where estado=1"))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$pie_class="si";
	require_once ('../../../public/views/plantilla.php');
?>