<?php 
if (isset($_REQUEST["id"])) {
	$tipo_venta=$_REQUEST["id"];
	//echo "tipo venta -->".$_POST["id"];
}else{echo "Error: Tipo de venta no definida";}
if($tipo_venta=="manual"){?>
	 <h4>VENTA MANUAL</h4>
		  <div class="form-group">
       <!--     <label>Seleccione Producto </label>
            <select class="selectpicker">
                <option>Carne</option>
                <option>Ketchup</option>
                <option>Huevo</option>
            </select> -->

          </div>
          <div class="form-group">
             <label>BUSQUEDA</label>
             <input type="text" id="busqueda" placeholder="" maxlength="30" autocomplete="off"  /><br>
             <label>resultado</label>
             <div id="resultado"> </div>
          </div>
      <?php  

}else{?>
	<h4>VENTA CON CÓDIGO DE BARRAS</h4>
		<div class="form-group">
      <label>Ingrese Código de barras</label>
      <input type="text" name="cod_barra" id="cod_barra" autofocus maxlength="13" autocomplete="false" onkeypress="leer()">
  	</div>
<?php }
?>
<script>
  $(document).ready(function(){
    var consulta;
         //hacemos focus al campo de búsqueda
        $("#busqueda").focus();

        //comprobamos si se pulsa una tecla
        $("#busqueda").keyup(function(e){

              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#busqueda").val();

              //hace la búsqueda
              $.ajax({
                    type: "POST",
                    url: "../../models/producto/buscar.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){
                          $("#resultado").empty();
                          $("#resultado").html(data);

                    }
              });

        });

});
</script>
