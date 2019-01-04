<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_limite" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Registrar de Limite de Producto</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmRegistrar" name="frmRegistrar">
                    <div class="form-group">
                        <label for="Nombre">Nombre del Producto</label>
                        <input class=" form-control" id="nombre" name="nombre" type="text"/>
                    </div><br>
                    
                    <div class="form-group">
                        <label for="user" class="control-label">Limite de Compra de Producto (en BS)</label>
                        <input class="form-control" id="limite" type="number" name="limite" />
                        
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

