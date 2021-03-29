<!-- Modal -->
<div class="modal fade" id="categModal" tabindex="-1" role="dialog" aria-labelledby="categModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="categModalLabel">Categoria</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="cleanCategModal();" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-cli" id="js-form-categ" enctype="multipart/form-data">
					<input type="hidden" name="type" id="type_categ" value="new">
					<input type="hidden" name="id_categ" id="id_categ" value="">
					<div class="form-group">
						<label for="order">Numero de aparicion</label>
						<input type="number" name="order" id="order_categ" placeholder="Numero de aparicion ej: 1">
					</div>
					<div class="form-group d-flex">
						<div style="width:75%">
							<label for="name">Imagen Icono</label>
							<input type="file" name="image" id="imagePreviewCateg" accept="image/gif, image/jpeg, image/png">
						</div>
						<div class="d-flex text-center" style="width:25%">
							<img src="img/sin-imagen.jpg" id="preview-img-categ" class="mx-auto" height="70px">
						</div>
					</div>
					<div class="form-group">
						<label for="title">Titulo</label>
						<input type="text" name="title" id="title_categ">
					</div>
					<!-- <div class="form-group">
						<label for="text">Color (opcional)</label>
						<input type="color" name="color" id="color">
					</div> -->
					<div class="form-group">
						<label for="link">Link</label>
						<input type="text" name="link" id="link_categ">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="cleanCategModal();" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="$('#js-form-categ').submit();">Guardar Cambios</button>
			</div>
		</div>
	</div>
</div>