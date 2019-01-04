<?php
  require_once ("../../config/db.php");
  require_once ("../../config/conexion.php");

  $id_categoria=$_REQUEST['id'];
  $sql="SELECT * FROM seccion WHERE id_categoria = {$id_categoria} and estado=1";
  if(!$secciones=$con->query($sql)){
    echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
  }
?>
<div class="col-md-12 well">
  <select name="seccion<?php echo $id_categoria; ?>" id="seccion<?php echo $id_categoria; ?>" class="seccion_class form-control" required="required" onchange="ver(<?php echo $id_categoria; ?>)">
    <option value="">Seleccione una seccion</option>
    <?php foreach ($secciones as $seccion): ?>
    <option value="<?php echo $seccion['id_seccion'] ?>"><?php echo $seccion['nombre'].' '.$seccion['limite'] ?></option>      
    <?php endforeach ?>
  </select>
  <div class="col-md-12 form-group" id="limite_<?php echo $id_categoria; ?>">
  </div>
</div>