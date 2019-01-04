<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                LIMITE DE PRODUCTO
                 <span class="pull-right">
                    <a href="#modal_limite" class="btn btn-xs btn-success" data-toggle="modal"><span class="fa  fa-pencil"></span> Nuevo limite</a>
                 </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE DEL PRODUCTO</th>
                                <th>LIMITE DE COMPRA DE PRODUCTO(BS)</th>
                                <th class="hidden-phone">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($limites as $limite): ?>
                                <tr class="gradeX">
                                    <td><?php echo $limite['id_limite']; ?></td>
                                    <td><?php echo $limite['nombre']; ?></td>
                                    <td><?php echo $limite['limite']; ?></td>
                                    <td ></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE DEL PRODUCTO</th>
                                <th>LIMITE DE COMPRA DE PRODUCTO(BS)</th>
                                <th class="hidden-phone">ACCIONES</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php require_once 'modal_limite.php'; ?>
        </section>
    </div>
</div>
<script>
    $(document).ready(function() {
         $('#frmRegistrar').validate({ 
            debug:true,
            rules:{
                nombre:{
                    required:true,
                    minlength: 3,
                    maxlength:25,
                },
                limite:{
                   required:true,
                    minlength: 2,
                    maxlength:4,
                    range:[1,9999],
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/limite/registro_model.php',
                    type: 'post',
                    data: $("#frmRegistrar").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response) {
                        if(response==1){
                            $('#modal_limite').modal('hide');
                            $('#btnRegistrar').attr({
                                disabled: 'true'
                            });
                            transicionSalir();
                            mensajes_alerta('DATOS REGISTRADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                            setTimeout(function(){
                                window.location.href='<?php echo ROOT_CONTROLLER ?>limite/index.php';
                            }, 3000);
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL REGISTRAR LIMITE DE PRODUCTO verifique los datos!! '+response,'error','REGISTRAR DATOS');
                        }
                    }
                });
            }
        });
    });
</script>