<?php
    require_once '../../config/route.php';
    session_start();
    if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
        header("location: " . ROOT_CONTROLLER . 'login/');
        exit;
    }
    require_once("../../config/db.php");
    require_once("../../config/conexion.php");
            //Variables para enviar a la plantilla
    $titulo = "Consutar Ventas";
    $contenido = "ventas/consultar_venta.php";
    $subTitulo = "Consultar Ventas";
    $sub_directory = "";
    $fecha_capturada = trim($_REQUEST["fechaConsulta"]);
    $fecha = date("Y-m-d");
    if (empty($fecha_capturada)) {
        $fecha = date("Y-m-d");
    } else {
        $fecha = date('Y-m-d', strtotime(trim($_REQUEST["fechaConsulta"])));
    }
        
    $menu_a = $menus['VENTAS_B'];

    if (!($ventas = $con->query("SELECT cl.nombre, cl.ci, id_compra, c.fecha FROM  compra_r as c , cliente as cl WHERE cl.id_cliente = c.id_cliente AND date(c.fecha) = '{$fecha}'"))) {
        echo "Falló consulta: (" . $con->errno . ") " . $con->error;
    }
        
        
            //var_dump($usuarios->fetch_assoc());
            //$pie_class="si";//Variable donde se poneun pie de pagina estatic
        //$pie_class = "no";
    require_once('../../../public/views/plantilla.php');
?>