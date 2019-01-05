<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Lista de Ventas Realizadas               
            </header>
            <div class="panel-body">

                <form class="form-horizontal" action="consultar_venta.php" method="get">
	                <div class="form-group">
	                    <label class="control-label col-md-2">Seleccione Fecha :</label>
	                    <div class="col-md-3 col-xs-11">
	                        <div data-date-viewmode="date" data-date="<?php echo date('d/m/Y'); ?>"  class="input-append date cFecha">
                                <input type="text" readonly="" size="16" class="form-control" name="fechaConsulta" id="fechaConsulta" value="<?php echo $fecha;?>">
                                <span class="input-group-btn add-on">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                            	</span>
                            </div>
                        </div>                       
                        
	                    <div class="col-sm-offset-1 col-md-3">
					    	<button type="submit" class="btn btn-info" data-toggle="modal" >Consultar Ventas</button>
					    </div>
                        
	                </div>
	            </form>

                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Fecha y Hora</th>
                                <th>Nombre Beneficiaria</th>
                                <th>CI</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta) : ?>
                                <tr class="gradeX">
                                    <td><?php echo $venta['fecha']; ?></td>
                                    <td><?php echo $venta['nombre']; ?></td>
                                    <td><?php echo $venta['ci']; ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="#modalMostrar" role="button" data-placement="top" title="Ver Recibo de Venta" data-toggle="modal" onclick="obtener_producto_recibo(<?php echo $venta['id_compra'] ?>)"><span class="fa fa-shopping-cart"></span>
                                        </a>
                                        <a class="btn btn-success" href="#modalEditar" role="button" data-placement="top" title="Imprimir Recibo" data-toggle="modal" onclick="obtener_datos(<?php echo $venta['id_compra'] ?>)"><span class="fa fa-print"></span>
                                        </a>
                                        <a class="btn btn-danger" href="#modalEliminar" role="button" data-toggle="modal" data-placement="top" title="Eliminar" onclick="eliminar_datos(<?php echo $venta['id_compra'] ?>)"><span class="fa fa-trash-o"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php //require_once 'modal_editar.php'; ?>
<?php require_once 'modal_eliminar.php'; ?>
<?php require_once 'modal_ver_recibo_venta.php'; ?>
<script>

    $(document).ready(function() {
		$('.cFecha').datepicker({
			format: 'dd-mm-yyyy'
		})
		.on('changeDate', function(ev){
			$('.cFecha').datepicker('hide');
		});
	});
	
    function obtener_datos(id){
        $.ajax({
            url: '../../models/cliente/datos_cliente.php',
            type: 'POST',
            dataType: "json",
            data: {id: id},
            success: function(datos){
                $("#name").val(datos['cliente']['nombre']);
                $("#ci").val(datos['cliente']['ci']);
                $("#id").val(datos['cliente']['id_cliente']);
            }
        });
    }

    function obtener_producto_recibo(id){
        $.ajax({
            url: '../../models/cliente/datos_cliente.php',
            type: 'POST',
            dataType: "json",
            data: {id: id},
            success: function(datos){
                $("#name").val(datos['cliente']['nombre']);
                $("#ci").val(datos['cliente']['ci']);
                $("#id").val(datos['cliente']['id_cliente']);
            }
        });
    }
    function eliminar_datos(id){

        fecha = document.getElementById("fechaConsulta").value;       
        //console.log('datos a eliminar-> '+id + " - "+fecha);
        $("#id_eliminar").val(id);
        $("#fecha").val(fecha);        
    }

    $(document).ready(function() {
        $('#frmEditar').validate({
            debug:true,
            rules:{
                name:{
                    required:true,
                    minlength: 4,
                    maxlength:40,
                },
                ci:{
                    required:true,
                    minlength:5,
                    maxlength:20,
                    remote: {
                        url: "../../models/cliente/verifica.php",
                        type: 'post',
                        data: {
                            ci: function() {
                                return $("#ci").val();
                            },
                            tipo: 'si',
                            id: function() {
                                return $("#id").val();
                            }
                        }
                    }
                },
            },
            messages:{
                ci:{
                    remote:"el numero de carnet ya esta registrado."
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/cliente/editar_model.php',
                    type: 'post',
                    data: $("#frmEditar").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response) {
                        if(response==1){
                            $('#modalEditar').modal('hide');
                            $('#btnEditar').attr({
                                disabled: 'true'
                            });
                            transicionSalir();
                            mensajes_alerta('DATOS EDITADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                            setTimeout(function(){
                                window.location.href='<?php echo ROOT_CONTROLLER ?>cliente/index.php';
                            }, 3000);
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL EDITAR EL USUARIO verifique los datos!! '+response,'error','EDITAR DATOS');
                        }
                    }
                });
            }
        });
        $("#btnEliminar").click(function(event) {
            $.ajax({
                url: '../../models/venta/eliminar_venta_model.php',
                type: 'POST',
                data: $("#frmEliminar").serialize(),
                beforeSend: function() {
                    transicion("Procesando Espere....");
                },
                success: function(response){
                    if(response != ""){
                        $('#modalEliminar').modal('hide');
                        $('#btnEliminar').attr({disabled: 'true'});
                        transicionSalir();
                        mensajes_alerta('COMPRA ELIMINADA EXITOSAMENTE !! ','success','ELIMINAR DATOS');
                        setTimeout(function(){
                            window.location.href='<?php echo ROOT_CONTROLLER ?>ventas/consultar_venta.php?fechaConsulta='+response;
                        }, 3000);
                    }else{
                        transicionSalir();
                        mensajes_alerta('ERROR AL ELIMINAR!! '+response,'error','ELIMINAR DATOS');
                    }
                }
            });
        });
    });
</script>