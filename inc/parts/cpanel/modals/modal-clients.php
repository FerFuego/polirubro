<!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clientModalLabel">Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-cli" id="js-form-cli">
            <input type="hidden" name="type_cli" id="type_cli" value="new">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="locality">Localidad</label>
                <input type="text" name="locality" id="locality">
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="email" name="mail" id="mail">
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" name="password" id="pass_cli">
            </div>
            <div class="form-group">
                <label for="type">Tipo</label>
                <select name="type" id="type">
                    <option value="">Seleccione</option>
                    <option value="0">0 - Precio Aumentado</option>
                    <option value="1">1 - Precio Descuento</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="$('#js-form-cli').submit();">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>