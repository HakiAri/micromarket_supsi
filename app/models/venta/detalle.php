<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php");
	$tManual=$_REQUEST['tipo'];
	$cod_barras=$_REQUEST['codigo'];
	if($tManual=="no"){
		$codPlu=substr($cod_barras,2, 4);
		$tipo=substr($codPlu,0, 1);
		if($tipo==2){
			$peso=substr($cod_barras,6, 5)/1000;
		}else{
			$peso=substr($cod_barras,6, 5)*1;
		}
	}else{
		$codPlu=$_REQUEST['codigo'];
		$peso=$_REQUEST['peso'];
	}	
	
	$sqlPrecio="select * from producto where cod_plu='{$codPlu}'";
	if($resultado=$con->query($sqlPrecio)){
		if($resultado->num_rows>0){
			$jsondata['estado']='correcto';
		}else {
			$jsondata['estado']='No';
		}
		//echo "<pre>";print_r ($resultado);echo "</pre>";
		$precio=1;
		while ($fila = $resultado->fetch_array()) {
			$jsondata['detalle'] = $fila;
			$precio=$fila['precio'];
		}
		$precioT = $precio*$peso;
		$jsondata['precioTotal']=round($precioT,2);
		$jsondata['peso']=$peso;
	}else{
		$jsondata['estado']="Falló consulta: (" . $con->errno . ") " . $con->error;
	}
	echo json_encode($jsondata);
?>