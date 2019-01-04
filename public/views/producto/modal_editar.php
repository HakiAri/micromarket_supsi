<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Editar Producto</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmEditar" name="frmEditar">
                    <input type="hidden" name="id_producto" id="id_producto" class="form-control" value="">
                    <div class="form-group">
                        <label for="Nombre">Numero de PLU</label>
                        <input class=" form-control" id="plu" name="plu" type="text" required autofocus="true" readonly="true" />
                    </div>
                    <div class="form-group">
                        <label for="Nombre">Nuevo Nombre del producto</label>
                        <input class=" form-control" id="nombre" name="nombre"  type="text" required autofocus="true" />
                    </div>

                    <div class="form-group">
                      <label for="nombre" >Tipo de venta </label>
                      <select  name="tipoVenta" id="tipoVenta" name="tipoVenta" class="form-control">
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="Nombre">precio del producto</label>
                        <input class=" form-control" id="precio" name="precio"  type="number" required autofocus="true" />
                    </div>

                    <div class="form-group">
                        <select name="seccion" id="seccion" class="seccion_class form-control" required="required">
                            <option value="">Seleccione una seccion</option>
                            <?php foreach ($secciones as $seccion): ?>
                            <option value="<?php echo $seccion['id_seccion'] ?>"><?php echo $seccion['nombre']; ?></option>
                            <?php endforeach ?>
                          </select>
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