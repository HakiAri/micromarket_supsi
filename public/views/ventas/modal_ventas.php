<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_ventas" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">REGISTRO DE NUEVO CLIENTE</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmRegistrar" name="frmRegistrar">
                    <div class="form-group">
                        <label for="Nombre">APELLIDOS Y NOMBRES</label>
                        <input class=" form-control" id="nombre" name="nombre" type="text"/>
                    </div><br>
                    <div class="form-group">
                        <label for="user" class="control-label">CARNET DE IDENTIDAD</label>
                        <input class="form-control" id="ci" type="text" name="ci" />
                    </div><br>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" >Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>