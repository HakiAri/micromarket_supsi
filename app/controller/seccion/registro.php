<?php
	require_once '../../config/route.php';
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ".ROOT_CONTROLLER.'login/');
		exit;
	}
	//Variables para enviar a la plantilla
	$titulo="Nueva categoria";
	$contenido="seccion/registro.php";
	$subTitulo="Seccion";
	$menu_a= array(
					'inicio'=>'',
					'usuario'=>'',
					'lista_u'=>'',
					'registro_u'=>'',
					'ventas'=>'',
					'seccion'=>'nav-active',
					'lista_s'=>'',
					'registro_s'=>'active',
					'producto'=>'',
					'lista_p'=>'',
					'registro_p'=>'',
					'cliente'=>'',
				);
	$pie_class="si";
	require_once ('../../../public/views/plantilla.php');
?>