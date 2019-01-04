<?php
  require_once ("../../config/db.php");
  require_once ("../../config/conexion.php");

  $sql="SELECT * FROM limite WHERE estado=1";
  if(!$limites=$con->query($sql)){
    echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
  }
?>
<hr>
<label>Selecione un limite para el derivado de la carne</label>
<select name="limite" id="limite" class="form-control" required="required">
  <option value="">Seleccione un limite</option>
  <?php foreach ($limites as $limite): ?>
  <option value="<?php echo $limite['id_limite']; ?>"><?php echo $limite['nombre'].' '.$limite['limite']; ?></option>      
  <?php endforeach; ?>
</select>