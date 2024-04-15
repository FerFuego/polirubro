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
					<input type="hidden" name="type" id="type_ban" value="new">
					<input type="hidden" name="id_banner" id="id_banner" value="">
					<div class="form-group">
						<label for="order">Numero de aparicion</label>
						<input type="number" name="order" id="order" placeholder="Numero de aparicion ej: 1">
					</div>
					<div class="form-group d-flex">
						<div style="width:75%">
							<label for="name">Imagen Banner</label>
							<input type="file" name="image" id="imagePreview" accept="image/gif, image/jpeg, image/png, image/webp">
						</div>
						<div class="d-flex text-center" style="width:25%">
							<img src="img/sin-imagen.jpg" id="preview-img" class="mx-auto" height="70px">
						</div>
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
					<div class="form-group">
						<label for="link">Es Mini Banner? (opcional)</label>
						<select name="small" id="small">
							<option value="No">No</option>
							<option value="Si">Si</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="$('#js-form-banner').submit();">Guardar Cambios</button>
			</div>
		</div>
	</div>
</div>