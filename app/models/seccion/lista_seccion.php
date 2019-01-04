<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	if(isset($_REQUEST['id'])){
		$sql="SELECT * FROM seccion WHERE id_categoria={$_REQUEST['id']}";
	}else{
		$sql="SELECT * FROM seccion where id_categoria=-1";
	}

	if (!($secciones = $con->query($sql))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$filas=$secciones->num_rows;
	if ($secciones->num_rows >0) {
		foreach ($secciones as $seccion): ?>
		    <tr class="gradeX">
		        <td><?php echo $seccion['id_seccion']; ?></td>
		        <td><?php echo $seccion['nombre']; ?></td>
		        <td><?php echo $seccion['valor_ticket']; ?></td>
		        <td ></td>
		    </tr>
		<?php endforeach;
	}else{
		echo '<tr> <td valign="top" colspan="4" class="dataTables_empty">no existen datos</td>
		</tr>';
	}
?>
