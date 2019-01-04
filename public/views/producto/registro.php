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
                      <label class="radio-inline">
                        <input type="radio" name="tipoVenta" id="tipoVenta" value="1" class="form-group tipoVenta" required=""> CANTIDAD
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="tipoVenta" id="tipoVenta" value="2" class="form-group tipoVenta" required=""> PESO
                      </label>
                      <em id="personalError"></em>
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
              </div>
              <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <h5>SECCIÓN</h5>
                <div class="col-md-12 well">
                  <select name="seccion" id="seccion" class="seccion_class form-control" required="required">
                    <option value="">Seleccione una seccion</option>
                    <?php foreach ($secciones as $seccion): ?>
                    <option value="<?php echo $seccion['id_seccion'] ?>"><?php echo $seccion['nombre']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
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
    $("#nro_plu").focus(function(){
      this.select();
    });
    $(".tipoVenta").change(function(event){
      var id = $(this).val();
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
          }else if ( element.prop( "type" ) === "radio" ) {
            error.insertAfter(element.next());
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
          },
          tipoVenta:{
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