<div class="row">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        REGISTRO DE PRODUCTO
      </header>
      <div class="panel-body">
        <div class="form">
          <form class="form-horizontal adminex-form" id="frmProducto" name="frmProducto">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <div class="form-group">
                  <label for="user" class="col-sm-4 control-label">NRO de PLU de balanza </label>
                  <div class="col-sm-8">
                    <div class="col-sm-6">
                      <input class="form-control text-right" autofocus="true" id="nro_plu" type="text" name="nro_plu" value="<?php echo $fila[0]; ?>"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cname" class="col-sm-4 control-label">Nombre del producto </label>
                  <div class="col-sm-8">
                    <div class="col-sm-12">
                      <input class=" form-control" id="nombre" name="nombre" type="text"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tipo" class=" col-sm-4 control-label">Tipo de venta </label>
                  <div class="col-sm-8">
                    <div class="col-sm-8">
                      <select  name="tipoVenta" id="tipoVenta" class="form-control">
                        <option value="" selected="selected">selecione una opcion</option>
                        <option value="1" >1.CANTIDAD</option>
                        <option value="2" >2.PESO</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="precio" id="mensaje" class="col-sm-4 control-label">Precio</label>
                  <div class="col-md-8">
                    <div class="col-md-7">
                      <input class="form-control tooltips" id="precio" name="precio" type="number" disabled="true" placeholder="precio por kilo/unidad" data-toggle="tooltip" data-original-title="Debe seleccionar el tipo de venta"/>
                    </div>
                  </div>
                </div>
                <div class="alert alert-info fade in">
                  <strong>¡Aviso!</strong> Debe asignar en que categoria se encontrarra el producto y en que seccion de la categoria.
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <h5>CATEGORÍA</h5>
                <?php $cont=0; ?>
                <?php foreach ($categorias as $categoria): ?>
                  <?php $cont++; ?>
                  <div class="form-group">
                    <div class="col-md-12 checkbox">
                      <label>
                      <input type="checkbox" id="categoria[]" name="categoria[]" class="cambio" value="<?php echo $categoria['id_categoria']; ?>">
                        <?php echo $categoria['nombre'];?>
                      </label>
                      <div class="col-md-12" id="resuldato_<?php echo $categoria['id_categoria']; ?>"></div>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>
              <em id="personalError"></em>
            </div>
            <div class="row form-group text-center">
              <div class="form-group">
                <button class="btn btn-primary" type="submit" id="btnRegistrar">Registrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>
<script>
  function ver(id){
    var idsec=$('#seccion'+id+'.seccion_class').find(':selected').val();
    if(idsec==4){
      $.ajax({
        url: '../../models/producto/select_limite.php',
        type: 'post',
        success: function(response) {
          $('#limite_'+id).html(response);
        }
      });
    }else if(idsec==5 || idsec==6 || idsec==7){
      $('#limite_'+id).empty();
    }
  }

  $(document).ready(function() {
    $('.cambio').change(function(event) {
      var mvalorc=$(this).val();
      if($(this).is(':checked')){
        $.ajax({
          url: '../../models/producto/select.php',
          type: 'post',
          data: {id: mvalorc},
          success: function(response) {
            $('#resuldato_'+mvalorc).html(response);
          }
        });
      }else{
        $('#resuldato_'+mvalorc).empty();
      }
    });
    $("#nro_plu").focus(function(){
      this.select();
    });
    $("#tipoVenta").change(function(event){
      var id = $("#tipoVenta").find(':selected').val();
      if(id==1){
        $("#mensaje").html("Precio por cantidad ");

      }else if(id==2){
        $("#mensaje").html("Precio por kilo ");
      }
      $("#precio").removeAttr('disabled');
      $("#precio").focus();
      $("#precio").removeAttr('data-toggle');
      $("#precio").removeAttr('data-original-title');
    });
    $('#btnRegistrar').click(function(event) {
      $("#frmProducto").validate({
        debug:true,
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter("#personalError");
            //error.appendTo(element.parent().next(''));
          } else {
            error.insertAfter( element );
          }
        },
        rules:{
          nombre:{
            required:true,
            minlength: 3,
            maxlength:25
          },
          nro_plu:{
            required:true,
            minlength:1,
            maxlength:4,
            range:[1,999],
            remote: {
              url: "../../models/producto/verifica.php",
              type: 'post',
              data: {
                plu: function() {
                  return $("#nro_plu").val();
                }
              }
            }
          },
          precio:{
            required:true,
            range:[0.1,999.99]
          },
          tipoVenta: {
            required: true
          },
          precio: {
            required:true,
            minlength:1,
            maxlength:4,
            range:[0.1,999.000]
          },
          'categoria[]':{
            required:true
          }
        },
        messages:{
          nombre:{
            required:"Este es Campo Obligatorio."
          },
          nro_plu:{
            required:"Este es Campo Obligatorio.",
            remote:"Este nro de plu ya existe digite otro"
          },
          precio:{
            required:"Este es Campo Obligatorio."
          },
          'categoria[]':{
            required:"Debe seleccionar al menos una categoria."
          }
        },
        submitHandler: function (form) {
          $.ajax({
            url: '../../models/producto/registro_model.php',
            type: 'post',
            data: $("#frmProducto").serialize(),
            beforeSend: function() {
              transicion("Procesando Espere....");
            },
            success: function(response) {
              if(response==1){
                $('#btnRegistrar').attr({
                  disabled: 'true'
                });
                transicionSalir();
                mensajes_alerta('DATOS GUARDADOS EXITOSAMENTE !! ','success','GUARDAR DATOS');
                setTimeout(function(){
                  window.location.href='<?php echo ROOT_CONTROLLER ?>producto/index.php';
                }, 3000);
              }else{
                transicionSalir();
                mensajes_alerta('ERROR AL REGISTRAR EL PRODUCTO verifique los datos!! '+response,'error','GUARDAR DATOS');
              }
            }
          });
        }
      });
    });
  });
</script>