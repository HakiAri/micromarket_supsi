<div class="row">
    <div class="col-md-12">
        <div class="panel">
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="col-md-12">
                            TIPO DE VENTA
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="manual" >
                                    Manual
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="barras" checked>
                                    Cod. Barras
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="resultado" class="jumbotron">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <form class="form-horizontal" role="form" name="frmVenta" id="frmVenta">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row panel-body">
										
                                        <div class="form-group">
                                            <label for="ci" class="col-lg-1 col-sm-2 control-label">C.I.</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" id="txt_ci" name="txt_ci" placeholder="Digite C.I. presione buscar" required>
                                            </div>
                                           
                                            <div class="col-md-1" id="buscarCliente">
                                                <button type="button" class="btn btn-info tooltips" data-toggle="tooltip" data-original-title="Presione para Buscar" id="btnBuscar"><span class="fa fa-search"></span></button>
                                            </div>
                                             <div class="col-md-1">
                                                <button type="button" class="btn btn-primary tooltips" data-toggle="tooltip" http://www.androidcurso.com/index.php/modulo-fundamentos/proyectos-finales-alumnosdata-original-title="Limpiar y volver a buscar" id="limpiar"><span class="fa fa-refresh"></span></button>
                                            </div>
											<label for="cliente" class="col-lg-1 col-sm-2 control-label">Cliente</label>
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" id="txt_usuario" name="txt_usuario" placeholder="Nombre del cliente" required readonly="true">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary" id="btnEnviar">Concluir venta</button>
                                        <button type="submit" class="btn btn-success" id="btnEnviar" onclick="imprime()">Imprimir recibo</button>
                                       
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-3"> 
									<h5>Carnes/Derivados</h5>
									<span class="label label-success">Cupones</span><br><br>
									<input type="text" id="sumcarnes" name="sumcarnes" value="0" size="3" readonly="true">
                                    <span>Bs</span>
									
                                </div>
								<div class="col-md-3"> 
									<h5>Pollo/Pescado</h5>
									<span class="label label-success">Cupones</span> <br><br>
									<input type="text" name="" value="0" id="sumpollos" name="sumpollos" size="3" readonly="true">
                                    <span>Bs</span>
                                </div>
								<div class="col-md-2"> 
									<h5>Verduras</h5>
									<span class="label label-success">Cupones</span> <br><br>
									<input type="text" id="sumverduras" name="sumverduras" value="0" size="3" readonly>
                                    <span>Bs</span>
                                </div>
								<div class="col-md-2"> 
									<h5>Tuberculos</h5>
									<span class="label label-success">Cupones</span> <br><br>
									<input type="text" name="sumtuberculos" id="sumtuberculos" value="0" size="3" readonly>
                                    <span>Bs</span>
                                </div>
								<div class="col-md-2"> 
									<h5>Frutas</h5>
									<span class="label label-success">Cupones</span> <br><br>
									<input type="text" name="sumfrutas" id="sumfrutas" value="0" size="3" readonly>
                                    <span>Bs</span>                                    
                                </div>
                            </div>
							
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="panel-heading">
                                        Detalle De Venta
                                    </div>
                                    <table class="table table-striped table-bordered" id="tablaDetalle">
                                        <thead>
                                            <tr>
                                                <th class="">Producto</th>
                                                <th class="">Precio Unitario</th>
                                                <th class="">Cantidad Peso</th>
                                                <th class="">Subtotal</th>
                                                <th class="">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="miDetalle">
                                        </tbody>
                                    </table>
                                    <div class="row text-right">
                                        <div class="col-md-12 panel-body">
                                            <label>Total </label>
                                            <input type="number" name="prec_total" id="prec_total" class="text-right" value="0" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'modal_ventas.php'; ?>
<script type="text/javascript">
    function imprime(){
        $('#frmVenta').validate({
            debug:true,
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/venta/registro_recibo.php',
                    type: 'post',
                    data: $("#frmVenta").serialize(),
                    beforeSend: function() {
                        $('#btnEnviar').attr('disabled', 'true');
                        $('#btnimprimir').attr('disbled', 'true');
                        transicion("Procesando Espere....");
                    },
                    success: function(response){
                        $('#btnEnviar').removeAttr('disabled');
                        $('#btnimprimir').removeAttr('disbled');
                        if(response==1){
                            transicionSalir();
                            mensajes_alerta('VENTA REALIZADA EXITOSAMENTE !! ','success','EDITAR DATOS');
                            $('#miDetalle').empty();
                            $('#prec_total').val('0');
                            $('#sumcarnes').val('0');
                            $('#sumpollos').val('0');
                            $('#sumverduras').val('0');
                            $('#sumtuberculos').val('0');
                            $('#sumfrutas').val('0');
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL REGISTRAR LA VENTA verifique los datos!! '+response,'error','REGISTRAR DATOS');
                        }
                    }
                });
            }
        });
    }
    $(document).ready(function(){
        $("#tablaDetalle").on('click', '.eliminar', function () {
            $(this).parents()
            $(this).closest('tr').remove();
        });
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
        $("input[name=optionsRadios]").click(function () {
            var valor=$(this).val();
            $.ajax({
                url: '../../models/venta/tipoventa.php',
                type: 'post',
                data: {id: valor},
                success: function(response) {
                    $('#resultado').html(response);
                }
            });
        });
        $('#btnEnviar').click(function(event) {
            $('#frmVenta').validate({
                debug:true,
                submitHandler: function (form) {
                    $.ajax({
                        url: '../../models/venta/registro_recibo.php',
                        type: 'post',
                        data: $("#frmVenta").serialize(),
                        beforeSend: function() {
                            $('#btnEnviar').attr('disabled', 'true');
                            $('#btnimprimir').attr('disbled', 'true');
                            transicion("Procesando Espere....");
                        },
                        success: function(response){
                            if(response==1){
                                $('#btnEnviar').attr('disabled', 'true');
                                $('#btnimprimir').attr('disbled', 'true');
                                transicionSalir();
                                mensajes_alerta('VENTA REALIZADA EXITOSAMENTE !! ','success','EDITAR DATOS');
                                setTimeout(function(){
                                    window.location.href='<?php echo ROOT_CONTROLLER ?>ventas/index.php';
                                }, 3000);
                            }else{
                                transicionSalir();
                                mensajes_alerta('ERROR AL REGISTRAR LA VENTA verifique los datos!! '+response,'error','REGISTRAR DATOS');
                            }
                        }
                    });
                }
            });
        });
        $('#resultado').load("../../models/venta/tipoventa.php?id=barras");
        $('#btnBuscar').click(function(event) {
            var ci=$("#txt_ci").val();
            if(ci.length>0){
                $.ajax({
                    url: '../../models/cliente/buscar.php',
                    type: 'post',
                    dataType: "json",
                    data: {id: ci},
                    success: function(datos) {
                        //console.log(datos);
                        //console.log(datos['estado']);
                        if(datos['estado']=="No"){
                            $("#buscarCliente").addClass('hide');
                            $("#nuevoCliente").removeClass('hide');
                            mensajes_alerta_pequeño('CLIENTE NO REGISTRADO !! debe registrarlo','warning','DATOS CLIENTE');
                        }else{
                            var cliente=datos['cliente'];
                            $("#txt_ci").val("");
                            $("#txt_ci").val(cliente['ci']);
                            $("#txt_usuario").val(cliente['nombre']);
                            $("#txt_ci").attr({readonly: 'true',});
                            mensajes_alerta_pequeño('CLIENTE REGISTRADO !! '+cliente['nombre'],'info','DATOS CLIENTE');
                        }
                    }
                });
            }else{
                mensajes_alerta_pequeño('debe escribir un C.I. !!','warning','ADVERTENCIA');
            }
        });
        $('input').keypress(function(e){
            if(e.which == 13){
              return false;
            }
        });
        $("#limpiar").click(function(event) {
            $("#buscarCliente").removeClass('hide');
            $("#nuevoCliente").addClass('hide');
            $("#txt_ci").val("");
            $("#txt_ci").removeAttr('readonly');
            $("#txt_usuario").val("");
            $("#txt_ci").focus();
        });
    });
    function leer(manual, mcodigo,pesoCantidad){
        var codigo=1;
        var tam=0;
        if(manual=="no"){
            codigo=$('#cod_barra').val();
            tam=13;
        }else{
            codigo=mcodigo;
            tam=4;
        }
        if(codigo.length==tam){
            $.ajax({
                url: '../../models/venta/detalle.php',
                type: 'post',
                dataType: "json",
                data: {
                    codigo: codigo,
                    tipo: manual,
                    peso: pesoCantidad
                },
                beforeSend: function() {
                    transicion("Obteniendo Datos....");
                },
                success: function(datos){
                    console.log('datos '+ datos);
                    transicionSalir();
                    
                    if(datos['estado']=='correcto'){
                        var total=$('#prec_total').val();
                        var detalle=datos['detalle'];
                        var id_seccion = detalle['idseccion'];
                        console.log("seccion -> "+id_seccion);
                        
                        switch (id_seccion) {
                            case '1':                            
                                
                                sumaparcial = $('#sumcarnes').val();
                                $('#sumcarnes').val(redondeo2decimales(sumaparcial*1+datos['precioTotal']));
                                break;
                            case '2':
                                
                                console.log('dos '+ id_seccion );
                                sumaparcial = $('#sumpollos').val();
                                $('#sumpollos').val(redondeo2decimales(sumaparcial*1+datos['precioTotal']));
                                break;
                            case '3':
                                
                                console.log('tres '+ id_seccion );                            
                                sumaparcial = $('#sumverduras').val();
                                $('#sumverduras').val(redondeo2decimales(sumaparcial*1+datos['precioTotal']));
                               break;

                            case '4':
               
                                console.log('cuatro '+ id_seccion );
                                sumaparcial = $('#sumtuberculos').val();
                                $('#sumtuberculos').val(redondeo2decimales(sumaparcial*1+datos['precioTotal']));
                                break;

                            case '5':
                            
                                console.log('cinco '+ id_seccion );
                                sumaparcial = $('#sumfrutas').val();
                                $('#sumfrutas').val(redondeo2decimales(sumaparcial*1+datos['precioTotal']));
                               break;

                            default:
                                break;
                        }
                        
                        $('#cod_barra').val('');
                        $('#miDetalle').append('<tr><td><input type="hidden" name="id_prod[]" value="'+detalle['id_prod']+'"><input type="text" class="text-center" readonly name="producto[]" id="producto[]" value="'+detalle['nombre']+'"></td><td><input type="text" name="precio[]" class ="text-right col-md-12" value="'+detalle['precio']+'" readonly></td><td><input type="text" name="cantpeso[]" class="text-right col-md-12" value="'+datos['peso']+'" readonly></td><td><input type="text" name="subtotal[]" class ="text-right col-md-12" value="'+datos['precioTotal']+'" readonly> <input type="hidden" name="codbarras[]" value="'+codigo+'"></td><td><button type="button" class="btn btn-danger eliminar" onclick="resta('+datos['precioTotal']+','+id_seccion+')"><span class="fa fa-trash-o"></span></button></td></tr>');

                        $('#prec_total').val(redondeo2decimales(total*1+datos['precioTotal']));
                    }else if (datos['estado']=='No') {
                        mensajes_alerta('No se encuentra el producto verifique','warning','ADVERTENCIA');
                        $('#cod_barra').val('');
                    }
                }
            });
        }
    }
    function resta(numero, idseccion){
        console.log('id ' + idseccion);
        numero=numero*1;
        idseccion = idseccion * 1;
        switch (idseccion) {
            case 1:
                sumaparcial =Number($('#sumcarnes').val()*1);
                subtot_redondeo = sumaparcial - numero;
                 $('#sumcarnes').val(redondeo2decimales(subtot_redondeo));
                break;
            case 2:
            
                sumaparcial =Number($('#sumpollos').val()*1);
                subtot_redondeo = sumaparcial - numero;
                 $('#sumpollos').val(redondeo2decimales(subtot_redondeo));
                break;
            case 3:
            
                sumaparcial =Number($('#sumverduras').val()*1);
                subtot_redondeo = sumaparcial - numero;
                 $('#sumverduras').val(redondeo2decimales(subtot_redondeo));
               break;

            case 4:
                
                sumaparcial =Number($('#sumtuberculos').val()*1);
                subtot_redondeo = sumaparcial - numero;
                 $('#sumtuberculos').val(redondeo2decimales(subtot_redondeo));
                break;

            case 5:
                
                sumaparcial =Number($('#sumfrutas').val()*1);
                subtot_redondeo = sumaparcial - numero;
                 $('#sumfrutas').val(redondeo2decimales(subtot_redondeo));
               break;

            default:
            console.log('ninguno');
                break;
        }
        
        var total=Number($('#prec_total').val()*1);
        var tot_redondeo=total-numero;
        $('#prec_total').val(redondeo2decimales(tot_redondeo));
    }
    function redondeo2decimales(numero){
        var flotante = parseFloat(numero);
        var resultado = Math.round(flotante*100)/100;
        return resultado;
    }
</script>