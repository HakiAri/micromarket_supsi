<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                REGISTRO CLIENTE
            </header>
            <div class="panel-body">
                <div class=" form">
                <form role="form" id="frmRegistrar" name="frmRegistrar">
                    <div class="form-group">
                        <label for="Nombre">APELLIDOS Y NOMBRES</label>
                        <input class=" form-control" id="nombre" name="nombre" type="text" minlength="7" required/>
                    </div><br>
                    <div class="form-group">
                        <label for="user" class="control-label">CARNET DE IDENTIDAD</label>
                        <input class="form-control" id="ci" type="text" name="ci" maxlength="11" required/>
                    </div><br>
                    <div class=" form-footer">
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" >Crear</button>
                    </div>
                    </form>
                </div>
            </div>
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
                    url: '../../models/cliente/registro_model.php',
                    type: 'post',
                    data: $("#frmRegistrar").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response){
                        if(response==1){
                            var nom=$('#nombre').val();
                            var ci=$('#ci').val();
                            $('#nombre').val('');
                            $('#ci').val('');
                            $('#txt_usuario').val(nom);
                            $('#txt_ci').val(ci);
                            $('#modal_ventas').modal('hide');
                            $('#btnRegistrar').attr({disabled: 'true'});
                            transicionSalir();
                            mensajes_alerta('DATOS REGISTRADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL REGISTRAR AL CLIENTE verifique los datos!! '+response,'error','REGISTRAR DATOS');
                        }
                    }
                });
            }
        });
    });
</script>