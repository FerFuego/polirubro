<!-- Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bannerModalLabel">Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form class="form-cli" id="js-form-banner" enctype="multipart/form-data">
            <input type="hidden" name="type" id="type_banner" value="new">
			      <div class="form-group">
                <label for="order">Numero de aparicion</label>
                <input type="text" name="order" id="order" placeholder="Numero de aparicion ej: 1">
            </div>
            <div class="form-group">
                <label for="name">Imagen Banner</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="title">Titulo (opcional)</label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="text">Texto (opcional)</label>
                <input type="text" name="text" id="text">
            </div>
            <div class="form-group">
                <label for="link">Boton Link (opcional)</label>
                <input type="text" name="link" id="link">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="$('#js-form-banner').submit();">Guardar</button>
      </div>
    </div>
  </div>
</div>