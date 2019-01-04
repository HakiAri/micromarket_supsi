<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_Registrar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Registrar Nueva Seccion</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmRegistrar" name="frmRegistrar">

                    <div class="form-group">
                        <label for="Nombre">Nombre de Seccion</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" />
                    </div>
                      <span>Limites por ticket</span> <br><br>

                    <div class="form-group row">

                              <div class="col-xs-2">
                                 <label>ticket 1</label>
                                 <input class="form-control btn btn-info" id="limite1" name="limite1" type="number" required="" value="0">
                              </div>

                             <div class="col-xs-2">
                                 <label>ticket 2</label>
                                 <input class="form-control btn btn-info" id="limite2" name="limite2" type="number">
                             </div>

                              <div class="col-xs-2">
                                 <label>ticket 3</label>
                                 <input class="form-control btn btn-info" id="limite3" name="limite3" type="number">
                             </div>
                            </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" >Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

