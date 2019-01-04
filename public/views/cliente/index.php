<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Lista de Clientes
                <span class="tools pull-right">
                    <a href="<?php echo ROOT_CONTROLLER; ?>cliente/registro.php" class="fa fa-plus"></a>
                 </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>C.I.</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr class="gradeX">
                                    <td><?php echo $cliente['ci']; ?></td>
                                    <td><?php echo $cliente['nombre']; ?></td>
                                    <td><?php echo $cliente['estado']; ?></td>
                                    <td>
                                        <a class="btn btn-success" href="#modalEditar" role="button" data-placement="top" title="Editar" data-toggle="modal" onclick="obtener_datos(<?php echo $cliente['id_cliente'] ?>)"><span class="fa fa-edit" ></span>
                                        </a>
                                        <a class="btn btn-danger" href="#modalEliminar" role="button" data-toggle="modal" data-placement="top" title="Eliminar" onclick="eliminar_datos(<?php echo $cliente['id_cliente'] ?>)"><span class="fa fa-trash-o"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php require_once 'modal_editar.php'; ?>
<?php require_once 'modal_eliminar.php'; ?>
<script>
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
    function eliminar_datos(id){
        $("#id_eliminar").val(id);
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
                url: '../../models/cliente/eliminar_model.php',
                type: 'POST',
                data: $("#frmEliminar").serialize(),
                beforeSend: function() {
                    transicion("Procesando Espere....");
                },
                success: function(response){
                    if(response==1){
                        $('#modalEliminar').modal('hide');
                        $('#btnEliminar').attr({disabled: 'true'});
                        transicionSalir();
                        mensajes_alerta('DATOS ELIMINADOS ELIMINADOS EXITOSAMENTE !! ','success','ELIMINAR DATOS');
                        setTimeout(function(){
                            window.location.href='<?php echo ROOT_CONTROLLER ?>cliente/index.php';
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