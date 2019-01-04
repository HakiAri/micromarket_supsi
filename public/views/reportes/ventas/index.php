<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Reporte de ventas por fecha
            </header>
            <div class="panel-body">
            	<form class="form-horizontal" action="../excel_reporte_venta.php" method="get">
	                <div class="form-group">
	                    <label class="control-label col-md-2">Seleccione Fecha para consulta de la venta :</label>
	                    <div class="col-md-3 col-xs-11">
	                        <div data-date-viewmode="date" data-date="<?php echo date('d/m/Y'); ?>"  class="input-append date cFecha">
                                <input type="text" readonly="" value="" size="16" class="form-control" name="fechaConsultaA" id="fechaConsultaA">
                                <span class="input-group-btn add-on">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                            	</span>
                            </div>
                        </div>
                        <label class="control-label col-md-1">a</label>
                        <div class="col-md-3 col-xs-11">
	                        <div data-date-viewmode="date" data-date="<?php echo date('d/m/Y'); ?>"  class="input-append date cFecha">
                                <input type="text" readonly="" value="" size="16" class="form-control" name="fechaConsultaB" id="fechaConsultaB">
                                <span class="input-group-btn add-on">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                            	</span>
                            </div>
                        </div>
                        
	                    <div class="col-sm-offset-1 col-md-3">
					    	<button type="button" class="btn btn-success" data-toggle="modal" onclick="verRepPDF()" data-target="#modalImprimir">Mostrar Reporte Ventas PDF <span class="fa fa-print"></span></button>
					    </div>
                        <div class="col-sm-offset-1 col-md-3">
					    	<button type="submit" class="btn btn-info" data-toggle="modal" >Mostrar Reporte Ventas Excel <span class="fa fa-file-text"></span></button>
					    </div>
	                </div>
	            </form>
            </div>
        </section>
    </div>
</div>
<?php require_once 'modal_imprimir.php'; ?>
<script>
	$(document).ready(function() {
		$('.cFecha').datepicker({
			format: 'dd-mm-yyyy'
		})
		.on('changeDate', function(ev){
			$('.cFecha').datepicker('hide');
		});
	});
	function verRepPDF(){
        var miFechaA=$('#fechaConsultaA').val();
        var miFechaB=$('#fechaConsultaB').val();
        console.log("Las Fechas son A: "+miFechaA+" y B:"+miFechaB);
		$('#cuerpo').html('<embed src="<?php echo ROOT_CONTROLLER?>reporte/pdf_reporte_venta.php?fecha_a='+miFechaA+'&fecha_b='+miFechaB+'" width="100%" height="600"></embed>');
    }
    function verRepExcel(){
        var miFechaA=$('#fechaConsultaA').val();
        var miFechaB=$('#fechaConsultaB').val();
        console.log("Las Fechas son A: "+miFechaA+" y B:"+miFechaB);
	}

    

</script>