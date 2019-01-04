<?php 
  require_once ("../../config/db.php");
  require_once ("../../config/conexion.php");
  $sql="SELECT * from producto where estado =1";
  if(!($productos=$con->query($sql))){
    echo "Falló consulta: (" . $con->errno . ") " . $con->error;
  }
  if (isset($_REQUEST["id"])) {
  	$tipo_venta=$_REQUEST["id"];
  	//echo "tipo venta -->".$_POST["id"];
  }else{echo "Error: Tipo de venta no definida";}
  if($tipo_venta=="manual"){?>
  <form id="frmManual">
  	<h4>VENTA MANUAL</h4>
  	<div class="form-group">
      <label for="producto">Seleccione Producto </label>
      <select class="chosen-select" id="mproducto" name="producto" data-placeholder="Seleccione un producto"  required="">
        <option value=""></option>
        <?php foreach ($productos as $producto): ?>
          <option value="<?php echo $producto['cod_plu'] ?>"><?php echo $producto['nombre'] ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Peso o cantidad</label>
      <input type="number" name="pesoCantidad" id="pesoCantidad" class="form-control" value="" required="required">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success" id="btnAñadir">Añadir</button>
    </div>
  </form>
  <?php }else{ ?>
  	<h4>VENTA CON CÓDIGO DE BARRAS</h4>
  		<div class="form-group">
        <label>Ingrese Código de barras</label>
        <input type="text" name="cod_barra" id="cod_barra" autofocus maxlength="13" autocomplete="false" onkeypress="leer('no',0)">
    	</div>
  <?php } ?>
  <script>
    var form = $("#frmManual");    
    $(document).ready(function() {
      var validado;
      $("#mproducto").on("change",function(){
        if(validado){
          validado.element($(this));
        }   
      });
      $("#mproducto").chosen({
        disable_search_threshold: 10,
        no_results_text: "No se encontro resultados!",
        width: "95%"
      });
      $('#btnAñadir').click(function(event) {
        //alert("id del producto "+idProd+" Peso o cantidad "+cantPeso);
        validado=form.validate({
          //debug: true,
          //onblur:false,
          errorPlacement:function(error, element){
            element.parents('.form-group').append(error);
          },
          ignore: ":hidden:not(.chosen-select)",
          submitHandler: function (form) {
            var cantPeso=$('#pesoCantidad').val();
            var codProd=$('#mproducto').find(':selected').val();
            //console.log("COD PRO ->"+codProd);
            leer('si',codProd,cantPeso);            
            $.ajax({
                url: '../../models/venta/tipoventa.php',
                type: 'post',
                data: {id: "manual"},
                success: function(response) {
                    $('#resultado').html(response);
                }
            });
          }
        });        
      });
    });
  </script>