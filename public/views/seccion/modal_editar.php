<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Editar Seccion</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmEditar" name="frmEditar">
                    <input type="hidden" name="id_seccion_modificar" id="id_seccion_modificar" class="form-control" value="">
                    <div class="form-group">
                        <label for="Nombre">Nuevo Nombre de Seccion</label>
                        <input class=" form-control" id="name" name="name" minlength="7 " type="text" required autofocus="true" />
                    </div><br>

                    <span>Limites por ticket</span> <br><br>

                    <div class="form-group row">
                        <div class="col-xs-2">
                                 <label>ticket 1</label>
                                 <input class="form-control" id="uno" name="uno" type="number" required>
                              </div>

                             <div class="col-xs-2">
                                 <label>ticket 2</label>
                                 <input class="form-control btn btn-info" id="dos" name="dos" type="number">
                             </div>

                              <div class="col-xs-2">
                                 <label>ticket 3</label>
                                 <input class="form-control btn btn-info" id="tres" name="tres" type="number">
                        </div>
                    </div>
                 
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnEditar" id="btnEditar">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>